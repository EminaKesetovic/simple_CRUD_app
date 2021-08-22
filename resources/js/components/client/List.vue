<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <button class="btn btn-primary" v-on:click="getClients()">Refresh</button>
            <router-link :to='{name:"clientAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Client</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <input type="search" class="form-control" v-model="filter">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th v-on:click="sortBy('id')">ID</th>
                                    <th v-on:click="sortBy('name')">Name</th>
                                    <th v-on:click="sortBy('address')">Address</th>
                                    <th v-on:click="sortBy('city_name')">City</th>
                                    <th v-on:click="sortBy('country_name')">Country</th>
                                    <th v-on:click="sortBy('industry_type_name')">Type of industry</th>
                                    <th>Actions</th>
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
                                    <td>
                                        <router-link :to='{name:"clientEdit",params:{id:client.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" v-on:click="deleteClient(client.id)" class="btn btn-danger">Delete</button>
                                        <router-link :to='{name:"clientShow",params:{id:client.id}}' class="btn btn-success">Show</router-link>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="7" align="center">No Clients Found.</td>
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
    name:"clients",
    data(){
        return {
            currentSort:'id',
            currentSortDir:'asc',
            filter:'',
            clients:[]
        }
    },
    mounted(){
        this.getClients()
    },
    methods:{
        async getClients(){
            await this.axios.get('/api/client').then(response=>{
                this.clients = response.data
            }).catch(error=>{
                console.log(error)
                this.clients = []
            })
        },
        sortBy(column) {
            //if column == current sort, reverse
            if(column === this.currentSort) {
            this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = column;
        },
        deleteClient(id){
            if(confirm("Are you sure to delete this client ?")){
                this.axios.delete(`/api/client/${id}`).then(response=>{
                    this.getClients()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    },
    computed:{
        filteredClients() {
            return this.clients.filter(client => {
                if(this.filter == '') return true;
                return client.name.toLowerCase().indexOf(this.filter.toLowerCase()) >= 0;
            })
        },
        sortedClients:function() {
            return this.filteredClients.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        }
    }
}
</script>
