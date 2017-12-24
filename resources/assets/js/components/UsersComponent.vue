<template>
    <div>
        <div v-if="isEditing">
            <div class="well well-sm" id="user-form">
                <div class="form-horizontal">
                    <fieldset>
                        <legend class="text-center"><span v-if="user.id">Edit</span><span v-else>Add</span> User</legend>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Name</label>
                            <div class="col-md-9" :class="{'has-error': errors.name}">
                                <input id="name"
                                       v-model="user.name"
                                       type="text"
                                       placeholder="User name"
                                       class="form-control">
                                <span v-if="errors.name" class="help-block text-danger">{{ errors.name[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">E-mail</label>
                            <div class="col-md-9" :class="{'has-error': errors.email}">
                                <input id="email"
                                       v-model="user.email"
                                       type="text"
                                       placeholder="User email"
                                       class="form-control">
                                <span v-if="errors.email" class="help-block text-danger">{{ errors.email[0] }}</span>
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
                    <h2 class="sub-header">User List</h2>
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
                        <tr v-for="user in users">
                            <td>{{user.id}}</td>
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td>
                                <button type="button" class="btn btn-primary" @click="showForm(user)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="warn(user.id)">Delete</button>
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
    export default {

        data() {
            return {
                users: [],
                pageCount: 1,
                endpoint: 'api/users?page=',
                page: 1,
                user: {
                    name: "",
                    email: "",
                },
                isEditing: false,
                errors: {},
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page = 1) {
                //used for refreshing
                this.page = page;
                axios.get(this.endpoint + page)
                    .then(({data}) => {
                        this.users = data.data;
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
                        axios.delete('api/users/'+id)
                            .then(({data}) => this.reload())
                            .catch(({response}) => this.notify(response));
                    } 
                });

            },

            showForm(user = {}) {
                this.isEditing = true;
                this.user = user;
            },

            hideForm() {
                this.isEditing = false;
            },

            save() {
                axios.post('api/users', this.user)
                    .then(({data}) => this.reload())
                    .catch(({response}) => this.notify(response));
            },

            setErrors(response) {
                this.errors = response.data.errors;
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
                this.errors = [];
                this.user = {};
            },

        }
    }
</script>