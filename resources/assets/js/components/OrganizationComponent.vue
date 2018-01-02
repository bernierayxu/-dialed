<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="model.id">Edit</span><span v-else>Add</span> {{ modelName }}</legend>
                        
                        <input-component v-model="model.code" name="code" rules="required" placeholder="Code"></input-component>
                        <input-component v-model="model.name" name="name" rules="required" placeholder="Name"></input-component>
                        <select-component v-model="model.type" attr="code" :options="organizationTypes" name="organizationTypes" rules="" placeholder="Organization Types"></select-component>                                    
                        <select-component v-model="model.parent" attr="code" :options="organizations" name="organization" rules="" placeholder="Parent Organization"></select-component>                                    
                        
                        <input-component v-model="model.number" name="number" rules="required" placeholder="Number"></input-component>
                        
                        <input-component v-model="model.bill_addr1" name="bill_addr1" rules="" placeholder="Bill Addr1"></input-component>
                        <input-component v-model="model.bill_addr2" name="bill_addr2" rules="" placeholder="Bill Addr2"></input-component>
                        <input-component v-model="model.bill_city" name="bill_city" rules="" placeholder="Bill City"></input-component>
                        <input-component v-model="model.bill_state" name="bill_state" rules="" placeholder="Bill State"></input-component>
                        <input-component v-model="model.bill_postal" name="bill_postal" rules="" placeholder="Bill Postal"></input-component>
                        <input-component v-model="model.bill_country" name="bill_country" rules="" placeholder="Bill Country"></input-component>
                        <input-component v-model="model.bill_email" name="bill_email" rules="" placeholder="Bill Email"></input-component>
                        <input-component v-model="model.bill_phone" name="bill_phone" rules="" placeholder="Bill Phone"></input-component>
                        <input-component v-model="model.ship_addr1" name="ship_addr1" rules="" placeholder="Ship Addr1"></input-component>
                        <input-component v-model="model.ship_addr2" name="ship_addr2" rules="" placeholder="Ship Addr2"></input-component>
                        <input-component v-model="model.ship_city" name="ship_city" rules="" placeholder="Ship City"></input-component>
                        <input-component v-model="model.ship_state" name="ship_state" rules="" placeholder="Ship State"></input-component>
                        <input-component v-model="model.ship_postal" name="ship_postal" rules="" placeholder="Ship Postal"></input-component>
                        <input-component v-model="model.ship_country" name="ship_country" rules="" placeholder="Ship Country"></input-component>
                        <input-component v-model="model.ship_email" name="ship_email" rules="" placeholder="Ship Email"></input-component>
                        <input-component v-model="model.ship_phone" name="ship_phone" rules="" placeholder="Ship Phone"></input-component>
                        <input-component v-model="model.ship_method" name="ship_method" rules="" placeholder="Ship Method"></input-component>
                        <input-component v-model="model.ship_acct_no" name="ship_acct_no" rules="" placeholder="Ship Acct No"></input-component>
                        
                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" @click="save()">Submit</button>
                                <button class="btn" @click="hideForm()">Cancel</button>
                            </div>
                        </div>

                    </fieldset>
                </div>
            </div>
        </div>


        <div v-if="!isEditing">
            <div class="row" >
                <div class="col-sm-10">
                    <h2 class="sub-header">{{ modelName }} List</h2>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-success" style="margin-top:19px" @click="showForm()">Add</button>
                </div>
            </div>

            <vue-good-table
              :columns="columns"
              :rows="models"
              :defaultSortBy="{field: 'created_at', type: 'desc'}"
              :globalSearch="true"
              :lineNumbers="true"
              :paginate="true"
              styleClass="table condensed table-bordered table-striped">
              <template slot="table-row-after" slot-scope="props">
                <td>
                    <button type="button" class="btn btn-primary" @click="showForm(props.row)">Edit</button>
                    <button type="button" class="btn btn-danger" @click="warn(props.row.id)">Delete</button>
                </td>
              </template>
            </vue-good-table>
        </div>

    </div>
</template>

<script>
    import baseMixin from '../mixins/baseMixin.js';
    export default {
        mixins: [ baseMixin ],
        data() {
            return {
                modelName: 'Organization',
                apiUrl: 'api/organizations',
                params: {
                  relations: ['organizations', 'organization_types']
                },
                //no need to mutate the following
                models: [],
                model: {},
                isEditing: false,
                columns: [
                    {
                      label: 'Parent',
                      field: 'organizations_code',
                    },
                    {
                      label: 'Type',
                      field: 'organization_types_code',
                    },
                    {
                      label: 'Code',
                      field: 'code',
                    },
                    {
                      label: 'Name',
                      field: 'name',
                    },
                    {
                      label: 'Number',
                      field: 'number',
                    },
                    {
                      label: 'Bill Addr1',
                      field: 'bill_addr1',
                    },
                    {
                      label: 'Bill Addr2',
                      field: 'bill_addr2',
                    },
                    {
                      label: 'Bill City',
                      field: 'bill_city',
                    },
                    {
                      label: 'Bill State',
                      field: 'bill_state',
                    },
                    {
                      label: 'Bill Postal',
                      field: 'bill_postal',
                    },
                    {
                      label: 'Bill Country',
                      field: 'bill_country',
                    },
                    {
                      label: 'Bill Email',
                      field: 'bill_email',
                    },
                    {
                      label: 'Bill Phone',
                      field: 'bill_phone',
                    },
                    {
                      label: 'Ship Addr1',
                      field: 'ship_addr1',
                    },
                    {
                      label: 'Ship Addr2',
                      field: 'ship_addr2',
                    },
                    {
                      label: 'Ship City',
                      field: 'ship_city',
                    },
                    {
                      label: 'Ship State',
                      field: 'ship_state',
                    },
                    {
                      label: 'Ship Postal',
                      field: 'ship_postal',
                    },
                    {
                      label: 'Ship Country',
                      field: 'ship_country',
                    },
                    {
                      label: 'Ship Email',
                      field: 'ship_email',
                    },
                    {
                      label: 'Ship Phone',
                      field: 'ship_phone',
                    },
                    {
                      label: 'Ship Method',
                      field: 'ship_method',
                    },
                    {
                      label: 'Ship Acct No',
                      field: 'ship_acct_no',
                    },
                    {
                      label: 'Actions'
                    },
                ]
            };
        },
        created() {
            this.fetchOrganizations();
            this.fetchOrganizationTypes();
        },
        methods: {
        },
    }
</script>