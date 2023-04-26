<template>
    <div
        class="nav-item w-100 p-2 me-1 mb-1 border border-1 border-dark rounded nav-item"
        :class="isHover ? 'bg-secondary' : 'bg-light'"
        @mouseover="isHover = true"
        @mouseleave="isHover = false"
        v-if="canAccess(item)"
    >
        <router-link :to="{name: item.routeName}" class="d-flex text-decoration-none nav-link" @click="drop = !drop">
            <icon :type="(item.icon ? item.icon : 'PersonCircle')" :size=24 class="nav-icon" variant="dark"></icon>
            <p
                class="m-0 ms-1 me-auto text-decoration-none align-self-center"
                :class="isHover ? 'text-light' : 'text-dark'"
            >
                {{ item.title }}
            </p>
            <icon :type="drop ? 'ChevronDown' : 'ChevronRight'" :size=24 v-if="!item.routeName && item.children" variant="dark"></icon>
        </router-link>
        <div class="list-unstyled ms-3 mt-1 nav flex-column" v-if="!item.routeName && item.children && drop">
            <nav-item v-for="(child, index) in item.children" :key="previousId + index" :item="child" dropped :previous-id="(previousId + index) * 10"></nav-item>
        </div>
    </div>
</template>

<script>
import { getUserData, isUserLoggedIn } from "../../auth/utils/useUserData";
import {object} from "yup";

export default {
    name: "navItem",
    props: {
        item: {
            type: Object,
            required: true,
        },
        previousId: {
            type: Number,
            default: 0
        },
        dropped: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            drop: false,
            isHover: false,
        }
    },
    setup() {
        return {
            getUserData,
            isUserLoggedIn
        }
    },
    methods: {
        canAccess(item) {
            const user = this.getUserData();
            const isLoggedIn = this.isUserLoggedIn();

            let canAccess = null;

            if (item?.security && item.security.length > 0) {
                for (let i = 0; i < item.security.length; i++) {
                    if (item.security[i] === 'FULLY_AUTHENTICATED' && isLoggedIn) {
                        if (item?.securityOperator === 'OR') {
                            canAccess = true;
                        } else {
                            if (canAccess === null) {
                                canAccess = true;
                            } else {
                                canAccess &= true;
                            }
                        }
                    } else if (item.security[i] === 'NOT_FULLY_AUTHENTICATED' && !isLoggedIn) {
                        if (item?.securityOperator === 'OR') {
                            canAccess = true;
                        } else {
                            if (canAccess === null) {
                                canAccess = true;
                            } else {
                                canAccess &= true;
                            }
                        }
                    } else if (user?.roles.includes(item.security[i])) {
                        if (item?.securityOperator === 'OR') {
                            canAccess = true;
                        } else {
                            if (canAccess === null)
                                canAccess = true;
                            else
                                canAccess &= true;
                        }
                    } else {
                        canAccess = false;
                    }
                }
            } else {
                canAccess = true;
            }

            return canAccess;
        },
    },
}
</script>

<style scoped>

</style>
