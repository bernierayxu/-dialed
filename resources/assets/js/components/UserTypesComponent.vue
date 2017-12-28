<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="model.id">Edit</span><span v-else>Add</span> {{ modelName }}</legend>
                        
                        <input-component v-model="model.code" name="code" rules="required" placeholder="Code"></input-component>
                        <input-component v-model="model.name" name="name" rules="required" placeholder="Name"></input-component>
                        <select-component v-model="model.organization_id" attr="code" :options="organizations" name="organization" rules="required" placeholder="Organization"></select-component>                                    
                        
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
                            <th>Organization</th>
                            <th>Code</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="model in models">
                            <td>{{model.id}}</td>
                            <td>{{model.organizations.code}}</td>
                            <td>{{model.code}}</td>
                            <td>{{model.name}}</td>
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
                modelName: 'User Type',
                apiUrl: 'api/user-types',
                params: {
                    page: 1,
                    relations: ['organizations']
                },
                //no need to mutate the following
                models: [],
                model: {},
                pageCount: 1,
                isEditing: false,
                organizations: [],
            };
        },
        created() {
            this.fetchOrganizations();
        },
        methods: {
        },
    }
</script>