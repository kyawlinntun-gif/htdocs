class Error{
    constructor() {
        this.errors = {};
    }

    get(field)
    {
        if(this.errors[field])
        {
            return this.errors[field][0];
        }
    }

    any()
    {
        return Object.keys(this.errors).length > 0;
    }

    has(field)
    {
        return this.errors.hasOwnProperty(field);
    }

    records(errors)
    {
        return this.errors = errors;
    }

    clear(field)
    {
        delete this.errors[field];
    }

}

new Vue({
   el: '#app',
    data: {
       items: {
           name: '',
           description: ''
       },
        errors: new Error(),
    },
    methods: {
       onSubmit(){
           axios.post('/store_data', this.items)
               .then(response => {
                   this.clearForm();
               })
               .catch(errors => {
                  console.log(errors.response.data.errors);
                  this.errors.records(errors.response.data.errors);
               });
       },

       clearForm()
       {
           this.items.name = '';
           this.items.description = '';
       }
    }
});
