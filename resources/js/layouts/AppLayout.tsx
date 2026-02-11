import Navbar from "@/Components/Navbar";
import Footer from "@/Components/Footer";
import React from "react";

export default function MainLayout({ children }: { children: React.ReactNode }) {
    return (
        <div className="min-h-screen bg-background">
            <Navbar />
            <main>{children}</main>
            <Footer />
        </div>
    );
}