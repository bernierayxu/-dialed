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

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Price Type</th>
                            <th>Display Order</th>
                            <th>Unit Cost</th>
                            <th>Is In Base</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="model in models">
                            <td>{{model.id}}</td>
                            <td>{{model.code}}</td>
                            <td>{{model.name}}</td>
                            <td><span v-if="model.prices">{{model.prices.code}}</span></td>
                            <td><span v-if="model.price_types">{{model.price_types.code}}</span></td>
                            <td>{{model.display_order}}</td>
                            <td>{{model.unit_cost}}</td>
                            <td>{{model.in_base ? 'Yes' : 'No'}}</td>
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
                modelName: 'Price Option',
                apiUrl: 'api/price-options',
                params: {
                    page: 1,
                    relations: ['prices', 'price_types']
                },
                //no need to mutate the following
                models: [],
                model: {},
                pageCount: 1,
                isEditing: false,
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