<template>
   <div class="container-fluid p-3">
    <div class="row justify-content-center g-0">
        <div class="col-8">
            <div class="card shadow">

                <div class="card-header bg-white d-flex gap-2 align-items-center justify-content-between">
                    <h4 class="text-muted">ChatGPT 3.5</h4>
                    <div class="d-flex gap-2">
                        <span class="p-3 rounded-circle bg-primary"></span>
                        <p class="m-0">{{profile?.first_name}}</p>

                        <div class="dropdown">
                            <span class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- <i class="fa fa-ellipsis"></i> -->
                            </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body" :class="(histories.length) ? '' : 'd-flex align-items-center justify-content-center'" style="height: 75vh;overflow: scroll;">
                    <div class="row justify-content-between" v-if="histories.length" v-for="(chat, index) in histories" :key="index">
                        <div class="col"></div>
                        <div class="col-10 d-flex flex-wrap justify-content-end align-self-end text-end">
                            <p class="bg-primary px-4 py-2 rounded-4">{{ chat.query }}</p>
                        </div>
                        <div class="col-10 d-flex flex-wrap justify-content-star align-self-start">
                            <p style="border: 2px solid;" class="border-primary px-4 py-2 rounded-4" v-html="chat.reply"></p>
                        </div>
                    </div>
                    <div v-else v-if="requestLoading == false" class="text-center text-muted">
                        <i class="fa fa-comment-dots" style="font-size: 56px;"></i>
                        <h6>No conversation yet.</h6>
                    </div>

                    <div class="row w-100 justify-content-between" v-if="requestLoading==true">
                        <div class="col"></div>
                        <div class="col-6 text-end">
                            <v-skeleton-loader type="heading"></v-skeleton-loader>
                        </div>
                        <div class="col-6">
                            <v-skeleton-loader type="heading"></v-skeleton-loader>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white border-0">
                    <form @submit.prevent="handleForm">
                        <div class="input-group">
                            <input type="text" v-model="inputs.message" class="form-control border-end-0 py-3" placeholder="Send a message" required />
                            <button class="input-group-text bg-white border-start-0" :disabled="(requestLoading == true) ? 'disabled' : null">
                                <i class="fa fa-paper-plane px-4" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
</template>

<script setup>
    import { ref, reactive, onMounted } from 'vue';
    import axios from 'axios';

    const inputs = reactive({
        "message" : ""
    });

    const profile = ref([]);
    const requestLoading = ref(false);
    const histories = ref([]);

    // reset Inputs
    const initialInputs = { ...inputs };
    const resetInputs = () => {
        Object.assign(inputs, initialInputs);
    }

    const handleForm = async () => {
        requestLoading.value = true
        try {
            // messages.value.push(inputs.message);
            const response = await axios.post("/openai/chat", inputs);
            resetInputs();
            histories.value = response.data;
            requestLoading.value = false;
        }
        catch (error) {
            console.log(error);
        }
    }

    const getHistories = async () => {
        try {
            // histories.value.push(inputs.message);
            const response = await axios.get("/openai/chat/history");
            histories.value = response.data;
        }
        catch (error) {
            console.log(error);
        }
    }

    const getProfile = async () => {
        try {
            const response = await axios.get("/profile");
            profile.value = response.data;
        }
        catch (error) {
            console.log(error);
        }
    }

    onMounted(getHistories(), getProfile());
</script>