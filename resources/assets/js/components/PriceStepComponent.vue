<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="model.id">Edit</span><span v-else>Add</span> {{ modelName }}</legend>
                        
                        <input-component v-model="model.min_quantity" name="min_quantity" rules="required|numeric" placeholder="Min Quantity"></input-component>
                        <input-component v-model="model.max_quantity" name="max_quantity" rules="required|numeric" placeholder="Max Quantity"></input-component>
                        <input-component v-model="model.price_group_std" name="price_group_std" rules="required|decimal:2" placeholder="Price Group Std"></input-component>
                        <input-component v-model="model.price_group_alt1" name="price_group_alt1" rules="required|decimal:2" placeholder="Price Group Alt1"></input-component>
                        <input-component v-model="model.price_group_alt2" name="price_group_alt2" rules="required|decimal:2" placeholder="Price Group Alt2"></input-component>
                        
                        <select-component v-model="model.price_id" attr="code" :options="prices" name="price" rules="required" placeholder="Price"></select-component>                                    
                        
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="model in models">
                            <td>{{model.id}}</td>
                            <td><span v-if="model.prices">{{model.prices.code}}</span></td>
                            <td>{{model.min_quantity}}</td>
                            <td>{{model.max_quantity}}</td>
                            <td>{{model.price_group_std}}</td>
                            <td>{{model.price_group_alt1}}</td>
                            <td>{{model.price_group_alt2}}</td>
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
                modelName: 'Price Step',
                apiUrl: 'api/price-steps',
                params: {
                    page: 1,
                    relations: ['prices']
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
        },
        methods: {
        },
    }
</script>