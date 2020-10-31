<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form2</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>

    <div id="app">
        <div class="container mt-5">
            <div class="row">
                <div class="col-6 offset-3">
                    <form action="" @submit.prevent="addItem" @keydown="errors.clear($event.target.name)">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" v-model="items.name" name="name">
                        </div>
                        <div class="alert alert-danger text-small" v-text="errors.get('name')" v-if="errors.has('name')"></div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" v-model="items.age" name="age">
                        </div>
                        <div class="alert alert-danger text-small" v-text="errors.get('age')" v-if="errors.has('age')"></div>
                        <div class="form-group">
                            <label for="profession">Profession:</label>
                            <input type="text" class="form-control" id="profession" v-model="items.profession" name="profession">
                        </div>
                        <div class="alert alert-danger text-small" v-text="errors.get('profession')" v-if="errors.has('profession')"></div>
                        <input type="submit" value="Submit" class="btn btn-primary" :disabled="errors.any()">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script>
        // const axios = require('axios').default;
        class Errors{
            constructor() {
                this.errors = [];
            }
            record(errors) {
                this.errors = errors;
            }
            get(field)
            {
                if(this.errors[field])
                {
                    return this.errors[field][0];
                }
            }
            has(field)
            {
                return this.errors.hasOwnProperty(field);
            }
            any()
            {
                return Object.keys(this.errors).length > 0;
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
                 age: '',
                 profession: ''
             },
             errors: new Errors
           },
           methods: {
               addItem() {
                   axios.post('/form2/add', this.items)
                   .then(response => {
                       alert(response.data.success);
                       this.clearForm();
                   })
                   .catch(errors => {
                      // console.log(errors.response.data.errors.name[0]);
                        this.errors.record(errors.response.data.errors);
                   });
               },
               clearForm()
               {
                   this.items.name='';
                   this.items.age='';
                   this.items.profession='';
               }
           }
        });
    </script>
</body>
</html>
