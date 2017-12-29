// define a mixin object
export default {
    data() {
        return {
            bool: [
                {
                    id: "1",
                    code: 'Yes'
                },
                {
                    id: "0",
                    code: 'No'
                },
            ],
            prices: [],
            organizations: [],
            priceTypes: [],
            currencys: [],
            organizationTypes: [],
            organizationTypes: [],
        }
    },
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
            let self = this;
            let promises = [];
            for (let child in this.$children) promises.push(this.$children[child].$validator.validateAll());

            Promise.all(promises)
                .then(function(results){
                    let res = results.filter(function(res) {
                        return !res;
                    });
                    if(res.length == 0) {
                        axios.post(self.apiUrl, self.model)
                            .then(({data}) => self.reload())
                            .catch(({response}) => self.notify(response.data.message, 'error'));     
                    }
                })
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

        fetchPrices() {
            axios.get('api/prices', {params: {'withoutPagination': true}})
                .then(({data}) => {
                    this.prices = data;
                });
        },

        fetchPriceTypes() {
            axios.get('api/price-types', {params: {'withoutPagination': true}})
                .then(({data}) => {
                    this.priceTypes = data;
                });
        },
        fetchCurrencys() {
            axios.get('api/currencys', {params: {'withoutPagination': true}})
                .then(({data}) => {
                    this.currencys = data;
                });
        },
        fetchOrganizationTypes() {
            axios.get('api/organization-types', {params: {'withoutPagination': true}})
                .then(({data}) => {
                    this.organizationTypes = data;
                });
        },
    }
};