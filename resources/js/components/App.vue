<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Simple CRUD app</router-link>
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link exact-active-class="active" to="/" class="nav-item nav-link">Home</router-link>
                        <router-link exact-active-class="active" to="/city" class="nav-item nav-link">Cities</router-link>
                        <router-link exact-active-class="active" to="/country" class="nav-item nav-link">Countries</router-link>
                        <router-link exact-active-class="active" to="/contact_type" class="nav-item nav-link">Contact Types</router-link>
                        <router-link exact-active-class="active" to="/industry_type" class="nav-item nav-link">Industry Types</router-link>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
    export default {}
</script>
