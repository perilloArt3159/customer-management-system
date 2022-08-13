<script setup>

import ComponentAppAlert from "@/Components/ComponentAppAlert.vue";

</script>

<style scoped lang="scss">

.wrapper 
{
    min-height     : 100vh;
    display        : flex;
    flex-direction : column;

    footer
    {
        margin-top : auto;
    }
}

</style>

<template lang="">
    <Head>
        <title></title>
    </Head>
    <div class="wrapper">
        <ComponentAppAlert/>
        <header>
        </header>
        <main>
            <div class="container">
                <slot/>          
            </div>
        </main>
        <footer>
        </footer>
    </div>
</template>