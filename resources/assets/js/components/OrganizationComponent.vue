<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="model.id">Edit</span><span v-else>Add</span> {{ modelName }}</legend>
                        
                        <input-component v-model="model.code" name="code" rules="required" placeholder="Code"></input-component>
                        <input-component v-model="model.name" name="name" rules="required" placeholder="Name"></input-component>
                        <input-component v-model="model.number" name="number" rules="required" placeholder="Number"></input-component>
                        
                        <input-component v-model="model.bill_addr1" name="bill_addr1" rules="required" placeholder="Bill Addr1"></input-component>
                        <input-component v-model="model.bill_addr2" name="bill_addr2" rules="required" placeholder="Bill Addr2"></input-component>
                        <input-component v-model="model.bill_city" name="bill_city" rules="required" placeholder="Bill City"></input-component>
                        <input-component v-model="model.bill_state" name="bill_state" rules="required" placeholder="Bill State"></input-component>
                        <input-component v-model="model.bill_postal" name="bill_postal" rules="required" placeholder="Bill Postal"></input-component>
                        <input-component v-model="model.bill_country" name="bill_country" rules="required" placeholder="Bill Country"></input-component>
                        <input-component v-model="model.bill_email" name="bill_email" rules="required" placeholder="Bill Email"></input-component>
                        <input-component v-model="model.bill_phone" name="bill_phone" rules="required" placeholder="Bill Phone"></input-component>
                        <input-component v-model="model.ship_addr1" name="ship_addr1" rules="required" placeholder="Ship Addr1"></input-component>
                        <input-component v-model="model.ship_addr2" name="ship_addr2" rules="required" placeholder="Ship Addr2"></input-component>
                        <input-component v-model="model.ship_city" name="ship_city" rules="required" placeholder="Ship City"></input-component>
                        <input-component v-model="model.ship_state" name="ship_state" rules="required" placeholder="Ship State"></input-component>
                        <input-component v-model="model.ship_postal" name="ship_postal" rules="required" placeholder="Ship Postal"></input-component>
                        <input-component v-model="model.ship_country" name="ship_country" rules="required" placeholder="Ship Country"></input-component>
                        <input-component v-model="model.ship_email" name="ship_email" rules="required" placeholder="Ship Email"></input-component>
                        <input-component v-model="model.ship_phone" name="ship_phone" rules="required" placeholder="Ship Phone"></input-component>
                        <input-component v-model="model.ship_method" name="ship_method" rules="required" placeholder="Ship Method"></input-component>
                        <input-component v-model="model.ship_acct_no" name="ship_acct_no" rules="required" placeholder="Ship Acct No"></input-component>
                        
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

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Bill Addr1</th>
                            <th>Addr2</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Postal</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ship Addr1</th>
                            <th>Addr2</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Postal</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Method</th>
                            <th>Acct No</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="model in models">
                            <td>{{model.id}}</td>
                            <td>{{model.code}}</td>
                            <td>{{model.name}}</td>
                            <td>{{model.number}}</td>
                            <td>{{model.bill_addr1}}</td>
                            <td>{{model.bill_addr2}}</td>
                            <td>{{model.bill_city}}</td>                            
                            <td>{{model.bill_state}}</td>
                            <td>{{model.bill_postal}}</td>
                            <td>{{model.bill_country}}</td>                            
                            <td>{{model.bill_email}}</td>
                            <td>{{model.bill_phone}}</td>
                            <td>{{model.ship_addr1}}</td>                            
                            <td>{{model.ship_addr2}}</td>
                            <td>{{model.ship_city}}</td>
                            <td>{{model.ship_state}}</td>                            
                            <td>{{model.ship_postal}}</td>
                            <td>{{model.ship_country}}</td>
                            <td>{{model.ship_email}}</td>
                            <td>{{model.ship_phone}}</td>
                            <td>{{model.ship_method}}</td>
                            <td>{{model.ship_acct_no}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" @click="showForm(model)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="warn(model.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="text-center">
                <paginate
                        :page-count="pageCount"
                        :click-handler="fetch"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'pagination'">
                </paginate>
            </div>
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
                    page: 1,
                },
                //no need to mutate the following
                models: [],
                model: {},
                pageCount: 1,
                isEditing: false,
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