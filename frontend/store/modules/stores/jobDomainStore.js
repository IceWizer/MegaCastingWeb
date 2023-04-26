import { useCrud } from "@store/utils";

const { name, store } = useCrud("job_domains");

export default {
    name,
    store,
}
