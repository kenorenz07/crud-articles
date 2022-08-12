<template>
    <div>
         <v-card
            class="mx-auto"
        >   
            <v-card-title>

                <h2>Articles</h2>
                <v-spacer></v-spacer>
                <v-btn @click="$router.push('/article/create')">Add</v-btn>
            </v-card-title>
            <v-card
                class="mx-auto"
                v-for="article in articles"
                :key="article.id"
            >
                <v-card-text>

                    <p class="text-h4 text--primary">{{article.title}} from {{article.created_at}}</p>
                    <div class="text--primary">{{article.content_trimmed}}</div>
                </v-card-text>
                <v-card-actions>
                    <v-btn text @click="$router.push('/article-show/'+article.id)">View</v-btn>
                    <v-btn text class="text-warning" @click="$router.push('/article/edit/'+article.id)">Edit</v-btn>
                    <v-btn text class="text-error" @click="deleteArticle(article.id)">Delete</v-btn>
                </v-card-actions>

            </v-card>
        </v-card>
    </div>
</template>
<script>
export default {
    data() {
        return {
            articles : []
        }
    },
    created(){
        this.initialize()
    },
    methods : {
        initialize(){
            this.$admin.get('article/index').then(({data}) => {
                this.articles = data
            }) 
        },
        deleteArticle(id){
            this.$admin.delete(`article/delete/${id}`).then(({data}) => {
                this.initialize()
            })
        }
    }
}
</script>