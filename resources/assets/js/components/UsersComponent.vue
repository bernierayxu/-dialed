<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="model.id">Edit</span><span v-else>Add</span> {{ modelName }}</legend>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Name</label>
                            <div class="col-md-9" :class="{'has-error': errors.has('name')}">
                                <input id="name"
                                       name="name"
                                       v-validate.initial="'required'"
                                       v-model="model.name"
                                       type="text"
                                       placeholder="User name"
                                       class="form-control">
                                <span v-show="errors.has('name')" class="help-block text-danger">{{ errors.first('name') }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">E-mail</label>
                            <div class="col-md-9" :class="{'has-error': errors.has('email')}">
                                <input id="email"
                                       name="email"
                                       v-validate.initial="'required|email'"
                                       v-model="model.email"
                                       type="text"
                                       placeholder="User email"
                                       class="form-control">
                                <span v-show="errors.has('email')" class="help-block text-danger">{{ errors.first('email') }}</span>
                            </div>
                        </div>


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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="model in models">
                            <td>{{model.id}}</td>
                            <td>{{model.name}}</td>
                            <td>{{model.email}}</td>
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
                modelName: 'User',
                apiUrl: 'api/users',
                models: [],
                model: {},
                pageCount: 1,
                page: 1,
                isEditing: false,
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page = 1) {
                //used for refreshing
                this.page = page;
                axios.get(this.apiUrl + '?page=' + page)
                    .then(({data}) => {
                        this.models = data.data;
                        this.pageCount = data.last_page;
                    });
            },

            warn(id) {
                this.$swal({
                    title: 'Are you sure you want to delete it?',
                    type: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        axios.delete(this.apiUrl + '/' + id)
                            .then(({data}) => this.reload())
                            .catch(({response}) => this.notify(response));
                    } 
                });

            },

            showForm(model = {}) {
                this.isEditing = true;
                this.model = model;
            },

            hideForm() {
                this.isEditing = false;
            },

            save() {
                axios.post(this.apiUrl, this.model)
                    .then(({data}) => this.reload())
                    .catch(({response}) => this.notify(response));
            },

            reload() {
                this.isEditing = false;
                this.fetch(this.page);
                this.reset();
                this.notify('Success');
            },
            notify(message = '') {
                this.$notify({
                    title: message,
                });                
            },

            reset() {
                this.model = {};
            },

        }
    }
</script>