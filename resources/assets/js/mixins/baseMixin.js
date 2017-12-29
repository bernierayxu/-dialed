// define a mixin object
export default {
    created() {
        this.fetch();
    },

    methods: {
        fetch(page = 1) {
            //used for refreshing
            this.page = page;
            axios.get(this.apiUrl, {params: this.params})
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
                        .catch(({response}) => this.notify(response, 'error'));
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
            console.log(this.$validator);
            this.$validator.validateAll().then((result) => {
                alert(result);
                if (result) {
                    // eslint-disable-next-line
                    axios.post(this.apiUrl, this.model)
                        .then(({data}) => this.reload())
                        .catch(({response}) => this.notify(response.data.message, 'error'));
                    return;
                }

                alert('Please correct errors!');
            });

        },

        reload() {
            this.isEditing = false;
            this.fetch(this.page);
            this.reset();
            this.notify('Success');
        },
        notify(message = '', type = 'info') {
            this.$notify({
                title: message,
                type: type,
            });                
        },

        reset() {
            this.model = {};
        },

        fetchOrganizations() {
            axios.get('api/organizations', {params: {'withoutPagination': true}})
                .then(({data}) => {
                    this.organizations = data;
                });
        },

    }
};