// define a mixin object
import signinMixin from './signinMixin.js';

export default {
    mixins: [ signinMixin ],
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
            params: {},
            prices: [],
            organizations: [],
            priceTypes: [],
            currencys: [],
            organizationTypes: [],
            config: {}
        }
    },
    created() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        axios.defaults.headers.common['Accept'] = 'application/json';
        // this.config.Authorization = 'Bearer ' + localStorage.getItem('token');
        // this.config.Accept = 'application/json';

        this.fetch();

    },

    methods: {
        fetch() {
            //used for refreshing
            axios.get(this.apiUrl, {params: this.params, headers: this.config})
                .then(({data}) => {
                    let params = this.params;
                    let bools = ['size_specific', 'in_base', 'is_active'];
                    data.forEach(function(model) {
                        if(params.relations) {
                            params.relations.forEach(function(relation) {
                                model[relation + '_code'] = model[relation]? model[relation].code : "";
                            })
                        }
                        bools.forEach(function(bool) {
                            if(typeof model[bool] != 'undefined') {
                                model[bool + '_bool'] = model[bool] ? 'Yes' : 'No';
                            }
                        })
                        
                    })

                    this.models = data;
                })
                .catch(({response}) => this.notify(response, 'error'));  
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
                            .catch(({response}) => self.notify(response, 'error'));     
                    }
                })
        },

        reload() {
            this.isEditing = false;
            this.fetch();
            this.reset();
            this.notify('Success');
        },
        notify(response = {}, type = 'info') {
            if(response.status != '200') {
                window.location = '/signin';
            } else {
                this.$notify({
                    title: response.data.message,
                    type: type,
                });                 
            }
        },

        reset() {
            this.model = {};
        },

        fetchOrganizations() {
            axios.get('api/organizations')
                .then(({data}) => {
                    this.organizations = data;
                }).catch(({response}) => this.notify(response, 'error'));  
        },

        fetchPrices() {
            axios.get('api/prices')
                .then(({data}) => {
                    this.prices = data;
                }).catch(({response}) => this.notify(response, 'error'));  
        },

        fetchPriceTypes() {
            axios.get('api/price-types')
                .then(({data}) => {
                    this.priceTypes = data;
                }).catch(({response}) => this.notify(response, 'error'));  
        },
        fetchCurrencys() {
            axios.get('api/currencys')
                .then(({data}) => {
                    this.currencys = data;
                }).catch(({response}) => this.notify(response, 'error'));  
        },
        fetchOrganizationTypes() {
            axios.get('api/organization-types')
                .then(({data}) => {
                    this.organizationTypes = data;
                }).catch(({response}) => this.notify(response, 'error'));  
        },
    }
};