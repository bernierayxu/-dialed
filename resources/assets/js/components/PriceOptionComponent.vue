<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="model.id">Edit</span><span v-else>Add</span> {{ modelName }}</legend>
                        
                        <input-component v-model="model.code" name="code" rules="required" placeholder="Code"></input-component>
                        <input-component v-model="model.name" name="name" rules="required" placeholder="Name"></input-component>
                        
                        <select-component v-model="model.price_id" attr="code" :options="prices" name="price" rules="required" placeholder="Price"></select-component>                                    
                        <select-component v-model="model.price_type" attr="code" :options="priceTypes" name="priceTypes" rules="required" placeholder="Price Types"></select-component>                                    
                        
                        <input-component v-model="model.display_order" name="display_order" rules="required|numeric" placeholder="Display Order"></input-component>
                        <input-component v-model="model.unit_cost" name="unit_cost" rules="required|decimal:2" placeholder="Unit Cost"></input-component>
                        <select-component v-model="model.in_base" attr="code" :options="bool" name="in_base" rules="required" placeholder="Is In Base"></select-component>                                    
                        
                        
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
                modelName: 'Price Option',
                apiUrl: 'api/price-options',
                params: {
                    relations: ['prices', 'price_types']
                },
                //no need to mutate the following
                models: [],
                model: {},
                isEditing: false,
                columns: [
                    {
                      label: 'Code',
                      field: 'code',
                    },
                    {
                      label: 'Name',
                      field: 'name',
                    },
                    {
                      label: 'Price Code',
                      field: 'prices_code',
                    },
                    {
                      label: 'Price Type',
                      field: 'price_types_code',
                    },
                    {
                      label: 'Display Order',
                      field: 'display_order',
                      type: 'number'
                    },
                    {
                      label: 'Unit Cost',
                      field: 'unit_cost',
                      type: 'number'
                    },
                    {
                      label: 'Is In Base',
                      field: 'in_base_bool',
                    },
                    {
                      label: 'Actions'
                    },
                ]
            };
        },
        created() {
            this.fetchPrices();
            this.fetchPriceTypes();
        },
        methods: {
        },
    }
</script>