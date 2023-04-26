import { useCrud } from "@store/utils";

const { name, store } = useCrud("jobs");

export default {
    name,
    store,
}
