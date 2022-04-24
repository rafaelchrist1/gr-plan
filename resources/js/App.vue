

<template>
    <div class="container"> 
        <nav class="navbar navbar-light bg-light navbar-expand-lg">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Listar Eletrodomésticos</router-link>
                    <router-link to="/create" class="nav-item nav-link">Criar Eletrodoméstico</router-link>
                </div>
            </div>
        </nav>
        
        <router-view> </router-view>
    </div>
</template>
 
<script>
    export default {}
</script>