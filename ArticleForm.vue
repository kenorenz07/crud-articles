<template>
    <div>
        <v-card>
            <v-card-title>
                <span class="text-h5">{{$route.params.id ? 'Edit' : 'Create'}} article</span>

            </v-card-title>
            <v-card-text>

                <v-text-field
                    label="Title"
                    v-model="article.title"
                >
                </v-text-field>
                 <v-text-field
                    label="Content"
                    v-model="article.content"
                >
                </v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-btn
                    text
                    @click="$router.push('/articles')"
                >
                    Cancel
                </v-btn>
                <v-btn
                    text
                    @click="save"
                >
                    Save
                </v-btn>

            </v-card-actions>
        </v-card>
    </div>
</template>
<script>
export default {
    data () {
        return {
            article : {
                title : '',
                content : ''
            }
        }
    },
    mounted () {
        if(this.$route.params.id)
            this.initialize()
    },
    methods : {
        initialize(){
            this.$admin.get('article/show/'+this.$route.params.id).then(({data})=> {
                this.article = data
            })
        },
        save(){
            if(this.$route.params.id) {
                this.$admin.put('article/update/'+this.$route.params.id,this.article).then(({data}) => {
                    this.$router.push('/articles')
                })
            } else {
                this.$admin.post('article/create',this.article).then(({data}) => {
                    this.$router.push('/articles')
                })
            }
        }
    }
}
</script>