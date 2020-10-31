<template>
    <div class="menu container_component">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <card-component>
                    <template slot="title">My Menu items</template>
                    <template slot="body">Content will come here</template>
                </card-component>
            </div>
            <div class="col-md-4">
                <card-component>
                    <template slot="title">Add Menu item</template>
                    <template slot="body">Form will come here</template>
                </card-component>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['items']
    }
</script>
