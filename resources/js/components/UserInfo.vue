<template>
    <div>
         <span class="text-muted">
    {{ postDate }}
                                        </span>
        <div class="media mt-2">
            <a :href="user.url" class="pr-2 ">
                <img :src="user.avatar" alt="">
            </a>
            <div class="media-body mt-1">
                <a :href="user.url">{{ user.name }}</a>
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        props:['model','label'],
        //in parent component <user-info model=".." label=",,"></user-info>
        computed:{
            postDate(){
                return this.label + " "+ this.model.created_date;
            },
            user(){
                console.log(this.model);
                return this.model.user
            }
        }
    }
</script>
