<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Todos los chats</h5>
                    
                </div>
                <router-link :to="{ name: 'chats.chat' }" class="btn btn-primary btn-sm float-end">
                        <div class="card mb-0">
                            <div class="flex justify-content-between mb-3">
                                <div>
                                    <span class="block text-500 font-medium mb-3">Orders</span>
                                    <div class="text-900 font-medium text-xl">152</div>
                                </div>
                                <div class="flex align-items-center justify-content-center bg-blue-100 border-round" style="width: 2.5rem; height: 2.5rem">
                                    <i class="pi pi-shopping-cart text-blue-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                </router-link>
            </div>
        </div>
    </div>
</template>