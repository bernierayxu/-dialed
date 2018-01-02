<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="model.id">Edit</span><span v-else>Add</span> {{ modelName }}</legend>
                        
                        <input-component v-model="model.min_quantity" name="min_quantity" rules="required|numeric" placeholder="Min Quantity"></input-component>
                        <input-component v-model="model.max_quantity" name="max_quantity" rules="required|numeric" placeholder="Max Quantity"></input-component>
                        <input-component v-model="model.price_group_std" name="price_group_std" rules="decimal:2" placeholder="Price Group Std"></input-component>
                        <input-component v-model="model.price_group_alt1" name="price_group_alt1" rules="decimal:2" placeholder="Price Group Alt1"></input-component>
                        <input-component v-model="model.price_group_alt2" name="price_group_alt2" rules="decimal:2" placeholder="Price Group Alt2"></input-component>
                        
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
                modelName: 'Price Step',
                apiUrl: 'api/price-steps',
                params: {
                    relations: ['prices']
                },
                //no need to mutate the following
                models: [],
                model: {},
                isEditing: false,
                columns: [
                    {
                      label: 'Price Code',
                      field: 'prices_code',
                    },
                    {
                      label: 'Min Quantit',
                      field: 'min_quantity',
                      type: 'number'
                    },
                    {
                      label: 'Max Quantit',
                      field: 'max_quantity',
                      type: 'number'
                    },
                    {
                      label: 'Price Group Std',
                      field: 'price_group_std',
                      type: 'number'
                    },
                    {
                      label: 'Price Group Alt1',
                      field: 'price_group_alt1',
                      type: 'number'
                    },
                    {
                      label: 'Price Group Alt2',
                      field: 'price_group_alt2',
                      type: 'number'
                    },
                    {
                      label: 'Actions'
                    },
                ]
            };
        },
        created() {
            this.fetchPrices();
        },
        methods: {
        },
    }
</script>