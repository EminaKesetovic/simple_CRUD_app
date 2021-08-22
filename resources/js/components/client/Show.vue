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
                            <label>Name</label>
                            <p>{{ client.name }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label>Address</label>
                            <p>{{ client.address }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label>City</label>
                            <p>{{ client.city_name }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label>Country</label>
                            <p>{{ client.country_name }}</p>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label>Type of industry</label>
                            <p>{{ client.industry_type_name }}</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody v-if="clients.length > 0">
                                <tr v-for="(client,key) in sortedClients" :key="key">
                                    <td>{{ client.id }}</td>
                                    <td>{{ client.name }}</td>
                                    <td>{{ client.address }}</td>
                                    <td>{{ client.city_name }}</td>
                                    <td>{{ client.country_name }}</td>
                                    <td>{{ client.industry_type_name }}</td>
                                </tr>
                            </tbody>
                        </table>
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
            clients:[]
        }
    },
    mounted(){
        this.showClient()
    },
    methods:{
        async showClient(){
            await this.axios.get(`/api/client/${this.$route.params.id}`).then(response=>{
                this.client = response.data
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
