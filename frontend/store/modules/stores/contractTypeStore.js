import { useCrud } from "@store/utils";

const { name, store } = useCrud("contract_types");

export default {
    name,
    store,
}
