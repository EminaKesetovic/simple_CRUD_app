<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <button class="btn btn-primary" v-on:click="getContactTypes()">Refresh</button>
            <router-link :to='{name:"contactTypeAdd"}' class="btn btn-success">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Contact Type</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <input type="search" class="form-control" v-model="filter" placeholder="Search contact types...">
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th v-on:click="sortBy('id')">ID</th>
                                    <th v-on:click="sortBy('name')">Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="contact_types.length > 0">
                                <tr v-for="(contact_type,key) in sortedContactTypes" :key="key">
                                    <td>{{ contact_type.id }}</td>
                                    <td>{{ contact_type.name }}</td>
                                    <td>
                                        <router-link :to='{name:"contactTypeEdit",params:{id:contact_type.id}}' class="btn btn-success">Edit</router-link>
                                        <button v-if="contact_type.clients_number == 0" type="button" v-on:click="deleteContactType(contact_type.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Contact Types Found.</td>
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
    name:"contact_types",
    data(){
        return {
            currentSort:'id',
            currentSortDir:'asc',
            filter:'',
            contact_types:[]
        }
    },
    mounted(){
        this.getContactTypes()
    },
    methods:{
        async getContactTypes(){
            await this.axios.get('/api/contact_type').then(response=>{
                this.contact_types = response.data
            }).catch(error=>{
                console.log(error)
                this.contact_types = []
            })
        },
        sortBy(column) {
            //if column == current sort, reverse
            if(column === this.currentSort) {
            this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = column;
        },
        deleteContactType(id){
            if(confirm("Are you sure to delete this contact type ?")){
                this.axios.delete(`/api/contact_type/${id}`).then(response=>{
                    this.getContactTypes()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    },
    computed:{
        filteredContactTypes() {
            return this.contact_types.filter(contact_type => {
                if(this.filter == '') return true;
                return contact_type.name.toLowerCase().indexOf(this.filter.toLowerCase()) >= 0;
            })
        },
        sortedContactTypes:function() {
            return this.filteredContactTypes.sort((a,b) => {
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
