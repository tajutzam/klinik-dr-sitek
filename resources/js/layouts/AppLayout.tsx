import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
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