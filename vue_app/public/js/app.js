new Vue({
    el: '#app',
    data: {
        items: []
    },
    mounted() {
        axios.get('/language').then(response => this.items = response.data);
    }
});
