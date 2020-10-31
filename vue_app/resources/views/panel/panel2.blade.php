<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel2</title>

    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
</head>
<body>
    <tabs id="app" class="container">
        <tab title="Home" :selected="true">Home</tab>
        <tab title="About Us">About Us</tab>
        <tab title="Contact Us">Contact Us</tab>
    </tabs>

    <script src="{{ asset('js/vue.js') }}"></script>
    <script>
        Vue.component('tabs', {
            template: `<div>
                            <div class="tabs">
                                <ul>
                                    <li v-for="tab in tabs" :class="{ 'is-active' : tab.isActive }"><a v-text="tab.title" v-on:click="selectedTab(tab)" :href="tab.href"></a></li>
                                </ul>
                            </div>
                            <div><slot></slot></div>
                        </div>`,
            data() {
                return {
                    tabs: {}
                }
            },
            mounted() {
                this.tabs = this.$children;
            },
            methods: {
                selectedTab(selectedTab) {
                    // this.tabs = this.tabs.map( tab => {
                    //     // if(tab.title == selectedTab.title)
                    //     // {
                    //     //     tab.isActive = true;
                    //     // }
                    //     // else
                    //     // {
                    //     //     tab.isActive = false;
                    //     // }

                    //     tab.isActive = (tab.title == selectedTab.title);

                    //     return tab;
                    // });

                    this.tabs.forEach( tab => {
                        tab.isActive = (tab.title == selectedTab.title);
                    });

                    // console.log(selectedTab);
                }
            },
        });
        Vue.component('tab', {
            template: `<div><slot></slot></div>`,
            props: {
                title: {required: true},
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
                    return '#' + this.title.toLowerCase().replace(/ /g, '-');
                }
            }
        })
        new Vue({
            el: '#app'
        });
    </script>
</body>
</html>