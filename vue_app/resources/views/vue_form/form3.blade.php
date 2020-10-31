<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form 3</title>

    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
</head>
<body>
    
    <div class="container mt-5" id="app">
        
        <form @submit.prevent="storeItems" @keydown="form.errors.clear($event.target.name)">
            <div class="field">
                <label class="label">Name</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Text input" v-model="form.name" name="name">
                </div>
                <p class="help is-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></p>
            </div>
    
            <div class="field">
                <label class="label">Profession</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Text input" v-model="form.profession" name="profession">
                </div>
                <p class="help is-danger" v-if="form.errors.has('profession')" v-text="form.errors.get('profession')"></p>
            </div>
    
            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-link" type="submit" :disabled="form.errors.any()">Submit</button>
                </div>
            </div>
        </form>

    </div>

    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script>
        class Form {
            constructor(data) {
                this.originalData = data;

                for (let field in data){
                    this[field] = data[field];
                }

                this.errors = new Errors;
            }

            data() {
                let data = Object.assign({}, this);

                delete data.originalData;
                delete data.errors;

                return data;
            }

            reset() {
                for (let field in this.originalData) {
                    this[field] = '';
                }
            }

            submit(requestType, url) {
                axios[requestType](url, this.data())
                    .then(this.onSuccess.bind(this))
                    .catch(this.onFail.bind(this));
            }

            onSuccess(response){
                alert(response.data.success);

                this.errors.clear();
                this.reset();
            }

            onFail(error) {
                this.errors.record(error.response.data.errors);
            }
        }
        class Errors {
            constructor() {
                this.errors = {};
            }
            clear(field){
                // delete this.errors[field];

                if(field) {
                    delete this.errors[field];

                    return;
                }

                this.errors = {};
            }
            any(){
                return Object.keys(this.errors).length > 0;
            }
            has(field){
                return this.errors.hasOwnProperty(field);
            }
            get(field){
                if(this.errors[field])
                {
                    return this.errors[field][0];
                }
            }
            record(errors) {
                this.errors = errors;
            }
        }
        new Vue({
            el: '#app',
            data: {
                // items: {
                //     name: '',
                //     profession: ''
                // },
                form: new Form({
                    name: '',
                    profession: ''
                }),
                // errors: new Errors
            },
            methods: {
                storeItems() {
                    this.form.submit('post','/form3/store');
                },
                clearItems() {
                    this.items.name = '';
                    this.items.profession = '';
                }
            }
        });
    </script>
</body>
</html>