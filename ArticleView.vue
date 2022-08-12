<template>
    <div>
        <v-card
            class="mx-auto">
            <v-card-title>
                <div>{{article.title}}</div>
            </v-card-title>
            <v-card-text>
               <div> {{article.content}}</div>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="vote(1)">Upvote</v-btn>
                <v-btn @click="vote(-1)" v-if="article.votes > 0">Downvote</v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>
<script>
export default {
    data() {
        return {
            article : {
                title :'',
                content : '',
                votes : 0
            }
        }
    },
    mounted () {
        this.initialize()
    },
    methods : {
        initialize () {
            this.$admin.get('article/show/'+this.$route.params.id).then((data)=> {
                this.article = data
            })
        },

        vote(value) {
            this.$admin.put('article/update-voute/'+this.$route.params.id+'/'+this.value).then((data)=>{
                this.initialize()
            })
        }
    }
}
</script>