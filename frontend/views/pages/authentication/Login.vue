<template>
    <div class="d-flex justify-content-center h-100">
        <div class="d-flex flex-column justify-content-center">
            <h1 class="text-center h1 mb-3">{{ app_name }}</h1>
            <div class="bg-light rounded p-5">
                <h2 class="text-center">Connexion</h2>
                <b-form style="width: 600px">
                    <div class="mt-2">
                        <label for="username">Nom</label>
                        <b-form-input
                            type="text"
                            name="username"
                            id="username"
                            v-model="item.username"
                            :state="stateOn.username ? validators.username.isValidSync(item.username) : null"
                            autocomplete="username"
                            @focus="stateOn.username = true"
                        />
                        <b-form-invalid-feedback
                            v-if="stateOn.username && !validators.username.isValidSync(item.username)"
                        >
                            {{ getErrorMessage(validators.username, item.username) }}
                        </b-form-invalid-feedback>
                    </div>
                    <div class="mt-2">
                        <label for="password">Mot de passe</label>
                        <b-input-group>
                            <b-form-input
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                id="password"
                                rules="required"
                                v-model="item.password"
                                :state="stateOn.password ? validators.password.isValidSync(item.password) : null"
                                autocomplete="current-password"
                                @focus="stateOn.password = true"
                            />
                            <b-input-group-append>
                                <b-button @click="showPassword = !showPassword" size="sm" variant="outline-secondary" class="text-dark rounded-end">
                                    <b-icon-eye v-if="showPassword" />
                                    <b-icon-eye-slash v-else />
                                </b-button>
                            </b-input-group-append>
                            <b-form-invalid-feedback>
                                {{ getErrorMessage(validators.password, item.password) }}
                            </b-form-invalid-feedback>
                        </b-input-group>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <b-button class="p-1 px-2" type="submit" @click="loginCheck()" variant="primary">Connecte toi</b-button>
                    </div>
                    <div class="text-bg-danger mt-2 rounded p-1" v-if="dataSent">
                        L'identifiant ou le mot de passe est incorrect
                    </div>
                </b-form>
                <div class="text-center mt-2">
                    <router-link to="register">Tu n'as pas de compte ?</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { login } from "@/auth/utils/connection";
import * as Yup from "yup";

export default {
    name: "Login",
    components: {

    },
    data() {
        return {
            item: {
                username: '',
                password: ''
            },
            stateOn: {
                username: false,
                password: false,
            },
            validators: {
                username: Yup.string().min(3, 'Username doit contenir au minimum 3 caractères').required('Le champ username est obligatoire'),
                password: Yup.string().required('Le champ password est obligatoire'),
            },

            showPassword: false,
            dataSent: false,
        }
    },
    setup() {
        return {
            Yup,
            app_name: process.env.APP_NAME || "Symfony"
        }
    },
    methods: {
        loginCheck() {
            let canSend = true;
            for (const [key, value] of Object.entries(this.item)) {
                if (!this.stateOn[key] || this.getErrorMessage(this.validators[key], value) !== null) {
                    canSend = false;
                }
            }

            if (canSend)
                this.sendLogin();
            else
                this.dataSent = true;
        },
        sendLogin() {
            this.$store.dispatch('authStore/login', this.item)
                .then((response) => {
                    login(response.data.token);
                    this.$router.push({ name: 'dashboard' });
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.dataSent = true;
                });
        },
        getErrorMessage(validator, itemToValidate) {
            try {
                validator.validateSync(itemToValidate);
                return null;
            } catch (err) {
                return err.message;
            }
        }
    }
}
</script>

<style scoped>
    .input {
        background-color: deeppink !important;
    }
</style>
