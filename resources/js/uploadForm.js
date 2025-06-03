import Swal from "sweetalert2";

const $forms = document.querySelectorAll(".upload-form");

$forms.forEach(($form) => {
    $form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formdata = new FormData($form);
        const data = Object.fromEntries(formdata);

        for (const key in data) {
            if (key.endsWith("[]")) {
                const values = formdata.getAll(key);
                delete data[key];
                data[key.replace("[]", "")] = [...values];
            }
        }

        // get data-* attributes
        const $target = $form.getAttribute("data-target");
        const $method = $form.getAttribute("data-method");
        const $showAlert = $form.getAttribute("data-show-alert") === "true";
        const $reload = $form.getAttribute("data-reload") === "true";
        const $reset = $form.getAttribute("data-reset") === "true";
        const $debug = $form.getAttribute("data-debug") === "true";
        const $redirect = $form.getAttribute("data-redirect");
        const $callback = $form.getAttribute("data-callback");

        if ($debug) console.log(data);

        // send request
        const response = await fetch($target, {
            method: $method,
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + localStorage.getItem("access-token"),
                Accept: "application/json",
            },
        });
        const responseData = await response.json();

        if ($debug) console.log(responseData);

        if (!responseData.success) {
            if ($showAlert) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: responseData.message,
                    background: "var(--color-base-100)",
                    color: "var(--color-base-content)",
                    confirmButtonText: "Está bien",
                    confirmButtonColor: "var(--color-primary)",
                });
            }
            return;
        }

        if ($callback) {
            const callback = window[$callback];
            if (callback && typeof callback === "function")
                callback(responseData);
        }

        if ($reset) $form.reset();

        if ($showAlert) {
            Swal.fire({
                icon: "success",
                title: "Success",
                text: responseData.message,
                background: "var(--color-base-100)",
                color: "var(--color-base-content)",
            }).then(() => {
                if ($reload) window.location.reload();
                if ($redirect) window.location.href = $redirect;
            });
        } else {
            if ($reload) window.location.reload();
            if ($redirect) window.location.href = $redirect;
        }
    });
});
