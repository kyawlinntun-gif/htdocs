<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel</title>

    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
</head>
<body>

    <div id="app" class="container mt-5">
        <tabs>
            <tab name="Home" :selected="true">Home Page</tab>
            <tab name="About Us">About Us Page</tab>
            <tab name="Contact Us">Contact Us Page</tab>
            <tab name="Welcome Us">Welcome Us Page</tab>
        </tabs>
    </div>

    <script src="{{ asset('js/vue.js') }}"></script>

    <script>
        Vue.component('tabs', {
            template: `<div>
                            <div class="tabs">
                              <ul>
                                <li v-for="tab in tabs" :class="{ 'is-active' : tab.isActive }"><a v-text="tab.name" @click="checkActive(tab)" :href="tab.href"></a></li>
                              </ul>
                            </div>
                            <div class="tab-details">
                                <slot></slot>
                            </div>
                        </div>`,
            mounted() {
                this.tabs = this.$children;
            },
            data() {
                return{
                    tabs: []
                }
            },
            methods: {
                checkActive(clickTab)
                {
                    this.tabs.forEach(tab => {
                       tab.isActive = (tab.name == clickTab.name);
                    });
                }
            },

        });
        Vue.component('tab', {
            template: `<div v-show="isActive"><slot></slot></div>`,
            props: {
                name: {required: true},
                selected: {default: false}
            },
            data() {
                return {
                    isActive: false
                }
            },
            mounted() {
                this.isActive = this.selected;
            },
            computed: {
                href() {
                    return '#' + this.name.toLowerCase().replace(/ /g, '-');
                }
            }
        });
        new Vue({
            el: '#app'
        })
    </script>
</body>
</html>
