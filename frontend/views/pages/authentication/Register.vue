<template>
    <div class="d-flex justify-content-center h-100">
        <div class="d-flex flex-column justify-content-center">
            <h1 class="text-center h1 mb-3">{{ app_name }}</h1>
            <div class="bg-light rounded p-5">
                <h2 class="text-center">Création de compte</h2>
                <b-form style="width: 600px">
                    <div class="mt-2">
                        <label for="username">Nom</label>
                        <b-form-input
                            type="text"
                            name="username"
                            id="username"
                            v-model="item.username"
                            :state="touch.username ? validateField('username') : null"
                            autocomplete="username"
                            @focus="touch.username = true"
                        />
                        <b-form-invalid-feedback>
                            {{ getErrorMessage('user') }}
                        </b-form-invalid-feedback>
                    </div>
                    <div class="mt-2">
                        <label for="email">Mail</label>
                        <b-form-input
                            type="text"
                            name="email"
                            id="email"
                            v-model="item.email"
                            :state="touch.email ? validateField('email') : null"
                            autocomplete="email"
                            @focus="touch.email = true"
                        />
                        <b-form-invalid-feedback>
                            {{ getErrorMessage('email') }}
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
                                :state="touch.password ? validateField('password') : null"
                                autocomplete="current-password"
                                @focus="touch.password = true"
                            />
                            <b-input-group-append>
                                <b-button @click="showPassword = !showPassword" size="sm" variant="outline-secondary" class="text-dark rounded-end">
                                    <b-icon-eye v-if="showPassword" />
                                    <b-icon-eye-slash v-else />
                                </b-button>
                            </b-input-group-append>
                            <b-form-invalid-feedback>
                                {{ getErrorMessage('password') }}
                            </b-form-invalid-feedback>
                        </b-input-group>
                    </div>
                    <div class="mt-2">
                        <label for="password">Confirmation du mot de passe</label>
                        <b-input-group>
                            <b-form-input
                                :type="showPasswordConf ? 'text' : 'password'"
                                name="password_conf"
                                id="password_conf"
                                rules="required"
                                v-model="item.password_conf"
                                :state="touch.password_conf ? validateField('password_conf') : null"
                                autocomplete="password_conf"
                                @focus="touch.password_conf = true"
                            />
                            <b-input-group-append>
                                <b-button @click="showPasswordConf = !showPasswordConf" size="sm" variant="outline-secondary" class="text-dark rounded-end">
                                    <b-icon-eye v-if="showPasswordConf" />
                                    <b-icon-eye-slash v-else />
                                </b-button>
                            </b-input-group-append>
                            <b-form-invalid-feedback>
                                {{ getErrorMessage('password_conf') }}
                            </b-form-invalid-feedback>
                        </b-input-group>
                    </div>
                    <div class="mt-2">
                        <b-form-checkbox
                            id="accept_terms"
                            name="accept_terms"
                            v-model="item.accept_terms"
                            :state="touch.accept_terms ? validateField('accept_terms') : null"
                            @focus="touch.accept_terms = true"
                        >
                            J'accepte les <a href="#">conditions générales d'utilisation</a>
                        </b-form-checkbox>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <b-button class="p-1 px-2" type="submit" @click="registerCheck()" variant="primary">Créer ton compte</b-button>
                    </div>
                </b-form>
                <div class="text-center mt-1">
                    <router-link to="login">Déjà un compte</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useModules } from "@store/utils";
import authStore from "@store/modules/authStore";
import {onUnmounted, ref} from "vue";
import * as Yup from "yup";

export default {
    name: "Register.vue",
    data() {
        return {
            item: {
                username: '',
                email: '',
                password: '',
                password_conf: '',
                accept_terms: false,
            },
            touch: {
                username: false,
                email: false,
                password: false,
                password_conf: false,
                accept_terms: false,
            },
            validators: {
                username: Yup.string()
                            .min(3, 'Nom doit contenir au minimum 3 caractères')
                            .required('Le champ nom est obligatoire'),
                email: Yup.string()
                            .email('L\'email doit être valide')
                            .required('Le champ email est obligatoire'),
                password: Yup.string()
                            .min(8, 'Le mot de passe doit avoir au minimum 8 caractères')
                            .matches(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).*$/, 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial (@$!%*?&)')
                            .required('Le champ mot de passe est obligatoire'),
                password_conf: Yup.string(),
                accept_terms: Yup.boolean()
                            .oneOf([true], 'Vous devez accepter les conditions générales d\'utilisation')
            },

            showPassword: false,
            showPasswordConf: false,

            errors: {}
        }
    },
    setup() {
        const modules = [
            {
                store: authStore,
            }
        ]
        const { umount } = useModules(modules);

        onUnmounted(() => {
            umount();
        });

        return {
            modules,
            Yup,
            app_name: process.env.APP_NAME || 'Symfony'
        }
    },
    methods: {
        registerCheck() {
            let canRegister = true;
            for (const [key, value] of Object.entries(this.item)) {
                if (!this.touch[key] || this.getErrorMessage(this.validators[key], value) !== null) {
                    canRegister = false;
                }
            }

            if (canRegister)
                this.sendRegister();
            else
                console.log('can not register');
        },
        sendRegister() {
            this.$store.dispatch('auth_store/register', this.item)
                .then(() => {
                    this.$router.push({name: 'login'});
                });
        },
        getErrorMessage(field) {
            try {
                if (field === 'password_conf') {
                    this.validators[field]
                        .oneOf([this.item.password], 'Les mots de passe ne correspondent pas')
                        .required('Le champ confirmation du mot de passe est obligatoire')
                        .validateSync(this.item[field]);
                } else {
                    this.validators[field].validateSync(this.item[field]);
                }

                return null;
            } catch (err) {
                return err.message;
            }
        },
        validateField(field) {
            if (field === 'password_conf') {
                return this.validators[field]
                    .oneOf([this.item.password], 'Les mots de passe ne correspondent pas')
                    .required('Le champ confirmation du mot de passe est obligatoire')
                    .isValidSync(this.item[field]);
            } else {
                return this.validators[field].isValidSync(this.item[field]);
            }
        }
    }
}
</script>

<style scoped>

</style>
