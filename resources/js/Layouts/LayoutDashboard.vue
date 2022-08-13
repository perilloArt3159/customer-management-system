<script setup>

import ComponentAppAlert  from "@/Components/ComponentAppAlert.vue";
import ComponentDashboardSidebar from "@/Components/ComponentDashboardSidebar.vue";
import ComponentDashboardNavbar from "@/Components/ComponentDashboardNavbar.vue";

</script>

<style scoped lang="scss">

#content 
{
    position      : relative; 
    display       : flex;
    flex-direction: row;

    #main 
    {
        min-height     : 100vh;
        display        : flex;
        flex-direction : column;
        position       : absolute; 
        width          : calc(100% - 60px); 
        height         : 100%; 
        left           : 60px;
        transition     : all 0.5s ease; 
        overflow-y     : auto;
    
        footer
        {
            margin-top : auto;
        }
    }

    #sidebar.active ~ #main 
    {
        width: calc(100% - 240px);
        left: 240px;
    }
}

</style>

<template lang="">
    <Head>
        <title></title>
    </Head>
    <div id="content">
        <ComponentDashboardSidebar/>
        <div id="main">
            <header class="mb-4">
                <ComponentDashboardNavbar/>
            </header>
            <main>
                <div class="container">
                    <div>
                        <ComponentAppAlert/>
                    </div>
                    <slot/>          
                </div>
            </main>
            <footer>
            </footer>
        </div>
    </div>
</template>