<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="model.id">Edit</span><span v-else>Add</span> {{ modelName }}</legend>
                        
                        <input-component v-model="model.name" name="name" rules="required" placeholder="User Name"></input-component>
                        <input-component v-model="model.email" name="email" rules="required|email" placeholder="Email"></input-component>
                        <input-component v-model="model.password" name="password" rules="required" placeholder="Password" type="password"></input-component>
                        <select-component v-model="model.user_type_id" attr="code" :options="userTypes" name="userTypes" rules="required" placeholder="User Type"></select-component>                                    
                        

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
                modelName: 'User',
                apiUrl: 'api/users',
                params: {
                  relations: ['user_types']
                },
                //no need to mutate the following
                models: [],
                model: {},
                isEditing: false,
                columns: [
                    {
                      label: 'Name',
                      field: 'name',
                      filterable: true,
                    },
                    {
                      label: 'Email',
                      field: 'email',
                      filterable: true,
                    },
                    {
                      label: 'Type',
                      field: 'user_types_code',
                      filterable: true,
                    },
                    {
                      label: 'Actions'
                    },
                ]
            };
        },
        created() {
          this.fetchUserTypes();
        },
        methods: {
        },
    }
</script>