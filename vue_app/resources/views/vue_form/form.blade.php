<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue app</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">

</head>
<body>
    <div id="app" class="mt-5">
        <div class="container">

            <form @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)">
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Enter name" v-model="items.name" name="name">
                    </div>
                    <p class="help is-danger" v-text="errors.get('name')" v-if="errors.has('name')"></p>
                </div>
                <div class="field">
                    <label class="label">Project Description</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Enter description" v-model="items.description" name="description">
                    </div>
                    <p class="help is-danger" v-text="errors.get('description')" v-if="errors.has('description')"></p>
                </div>
                <div class="field">
                    <button class="button is-link" :disabled="errors.any()">Submit</button>
                </div>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('js/vue_form.js') }}"></script>
</body>
</html>
