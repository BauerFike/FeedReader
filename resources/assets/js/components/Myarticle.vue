<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        {{counter}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        ready() {
            console.log('Component ready.')
        },
        data () {
            return {
                counter: 'Hello world!'
            }
        },
        methods: {
            getArticles: function(){
                this.$http.get(window.location.pathname+'?ajax=1&page='+page)
            },
            checkScroll: function(){
                console.log("scrolling");
            }
        }
    }
</script>
