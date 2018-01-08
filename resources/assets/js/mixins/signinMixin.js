// define a mixin object
export default {

    methods: {

        signin() {
            axios.post('api/signin', this.params)
                .then(({data}) => this.setToken(data))
                .catch(({response}) => this.$notify({title: response.data.message, type: 'error'}));
        },

        setToken(token) {
            localStorage.setItem('token', token);
            window.location="/";
        },

        signout() {
            localStorage.removeItem('token');
            window.location="/signin";
        },

    }
};