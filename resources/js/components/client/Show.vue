<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Client</h4>
                </div>
                <div class="card-body">
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <b>Name: </b><p>{{ client.name }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <b>Address: </b><p>{{ client.address }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <b>City: </b><p>{{ client.city_name }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <b>Country: </b><p>{{ client.country_name }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <b>Industry type: </b><p>{{ client.industry_type_name }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <b>Contacts: </b>
                             <ul>
                                <li v-for="(contact,key) in contacts" :key="key">
                                    <b>{{ contact.name }}:</b> <p>{{ contact.pivot.contact }}</p>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"client",
    data(){
        return {
            client:'',
            contacts:[]
        }
    },
    mounted(){
        this.showClient()
    },
    methods:{
        async showClient(){
            await this.axios.get(`/api/client/${this.$route.params.id}`).then(response=>{
                this.client = response.data
                this.contacts = response.data.contacttypes
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
