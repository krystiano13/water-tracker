import { Head, Link, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { Card } from 'primereact/card';
import { Button } from 'primereact/button';

export default function Login({
    status,
    canResetPassword,
}: {
    status?: string;
    canResetPassword: boolean;
}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: true,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <main style={{ width: "100vw", height: "100vh", display: "flex", justifyContent: "center", alignItems: "center" }}>
            <Head title="Login" />
            <Card style={{ padding: "2rem" }}>
               <div style={{ display: "flex", flexDirection: "column", alignItems: "center" }}>
                   <h1>Synchronize Your Data</h1>
                   <p>And Continue Tracking on Multiple Devices</p>
                   <a href={route("auth.google")}>
                       <Button style={{ gap: "1rem", marginTop: "1.5rem" }}>
                           <span className="pi pi-google"></span>
                           <span>Continue With Google</span>
                       </Button>
                   </a>
                   <Button style={{ gap: "1rem", marginTop: "1.5rem" }}>
                       <span className="pi pi-facebook"></span>
                       <span>Continue With Facebook</span>
                   </Button>
               </div>
            </Card>
        </main>
    );
}
