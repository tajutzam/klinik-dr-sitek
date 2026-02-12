import React from 'react';
import MainLayout from "@/layouts/AppLayout";
import { MapPin, Phone, Mail, Clock, Send, ExternalLink, MessageCircle, AlertCircle } from "lucide-react";

const Contact = () => {
    const address = "Jl. Merdeka No. 45, Baning Kota, Sintang, Kalimantan Barat";
    const googleMapsEmbedUrl = `https://maps.google.com/maps?q=${encodeURIComponent(address)}&t=&z=15&ie=UTF8&iwloc=&output=embed`;
    const googleMapsDirectUrl = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}`;

    return (
        <div className="font-sans text-slate-900 bg-white">
            <section className="bg-slate-50 py-16 px-6 text-center border-b border-slate-100">
                <h1 className="text-3xl md:text-4xl font-bold mb-4 text-slate-900">Hubungi Kami</h1>
                <p className="text-slate-500 max-w-2xl mx-auto text-sm md:text-base">
                    Ada pertanyaan atau ingin membuat janji konsultasi? Kami siap membantu Anda.
                </p>
            </section>

            <section className="py-16 px-6 md:px-12 lg:px-24 max-w-7xl mx-auto">
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">

                    <div className="space-y-10">
                        <h2 className="text-2xl font-bold text-slate-900">Informasi Kontak</h2>
                        <div className="space-y-8">
                            <div className="flex gap-5">
                                <div className="bg-primary/10 p-3 rounded-xl h-fit">
                                    <MapPin className="w-6 h-6 text-primary" />
                                </div>
                                <div>
                                    <h3 className="font-bold text-slate-900 mb-1">Alamat Praktik</h3>
                                    <p className="text-slate-500 text-sm leading-relaxed">{address}</p>
                                </div>
                            </div>

                            <div className="flex gap-5">
                                <div className="bg-primary/10 p-3 rounded-xl h-fit">
                                    <Phone className="w-6 h-6 text-primary" />
                                </div>
                                <div>
                                    <h3 className="font-bold text-slate-900 mb-1 text-nowrap">Telepon</h3>
                                    <p className="text-slate-500 text-sm">+62 123 456 789</p>
                                </div>
                            </div>
                            <div className="flex gap-5">
                                <div className="bg-primary/10 p-3 rounded-xl h-fit">
                                    <Mail className="w-6 h-6 text-primary" />
                                </div>
                                <div>
                                    <h3 className="font-bold text-slate-900 mb-1 text-nowrap">Email</h3>
                                    <p className="text-slate-500 text-sm">dr.sitek@health.com</p>
                                </div>
                            </div>

                            <div className="flex gap-5">
                                <div className="bg-primary/10 p-3 rounded-xl h-fit">
                                    <Clock className="w-6 h-6 text-primary" />
                                </div>
                                <div>
                                    <h3 className="font-bold text-slate-900 mb-1 text-nowrap">Jam Operasional</h3>
                                    <p className="text-slate-500 text-sm">Senin – Sabtu: 08.00 - 13.00 | 17.00 - 21.00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="bg-slate-50 p-8 md:p-10 rounded-[2.5rem] border border-slate-100">
                        <h2 className="text-2xl font-bold text-slate-900 mb-2">Kirim Pesan</h2>
                        <p className="text-slate-500 text-sm mb-8">Kami akan segera menghubungi Anda kembali.</p>

                        <form className="space-y-5" onSubmit={(e) => e.preventDefault()}>
                            <div className="space-y-1.5">
                                <label className="text-xs font-bold text-slate-700 uppercase ml-1">Nama Lengkap *</label>
                                <input type="text" placeholder="Nama Anda" className="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm transition-all" />
                            </div>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div className="space-y-1.5">
                                    <label className="text-xs font-bold text-slate-700 uppercase ml-1">Telepon *</label>
                                    <input type="tel" placeholder="+62..." className="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm" />
                                </div>
                                <div className="space-y-1.5">
                                    <label className="text-xs font-bold text-slate-700 uppercase ml-1">Email</label>
                                    <input type="email" placeholder="email@contoh.com" className="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm" />
                                </div>
                            </div>
                            <div className="space-y-1.5">
                                <label className="text-xs font-bold text-slate-700 uppercase ml-1">Pesan Anda *</label>
                                <textarea rows={3} placeholder="Tuliskan pesan..." className="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm resize-none"></textarea>
                            </div>
                            <button className="w-full bg-primary text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 flex items-center justify-center gap-2 hover:opacity-95 active:scale-[0.99] transition-all">
                                <Send className="w-4 h-4" /> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

                <div className="mt-16 flex flex-col gap-6 items-center border-t border-slate-100 pt-10">
                    <div className="flex justify-center md:justify-start">
                        <a
                            href="https://wa.me/62123456789"
                            target="_blank"
                            rel="noreferrer"
                            className="flex items-center justify-center gap-3 bg-[#22c55e] hover:bg-[#1eb054] text-white font-bold py-4 px-10 rounded-2xl transition-all active:scale-95 shadow-lg shadow-green-100 w-full md:w-auto text-center"
                        >
                            <MessageCircle className="w-5 h-5" />
                            Chat via WhatsApp Sekarang
                        </a>
                    </div>

                    <div className="bg-primary/5 border border-primary/10 p-5 rounded-2xl flex gap-4 items-center">
                        <div className="bg-primary/20 p-2.5 rounded-full shrink-0">
                            <AlertCircle className="w-5 h-5 text-primary" />
                        </div>
                        <div>
                            <h4 className="font-bold text-slate-800 text-sm mb-0.5 uppercase tracking-wide">Panggilan Darurat?</h4>
                            <p className="text-slate-500 text-xs leading-relaxed">
                                Segera hubungi <span className="font-bold text-primary">119</span> atau kunjungi IGD terdekat jika Anda dalam kondisi kritis.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section className="py-16 px-6 md:px-12 lg:px-24 max-w-7xl mx-auto">
                <div className="relative rounded-[2.5rem] overflow-hidden shadow-2xl border border-slate-100">
                    <div className="w-full h-[400px] md:h-[500px]">
                        <iframe width="100%" height="100%" style={{ border: 0 }} loading="lazy" src={googleMapsEmbedUrl}></iframe>
                    </div>
                    <div className="absolute bottom-0 left-0 right-0 bg-primary/95 backdrop-blur-sm p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                        <div className="flex items-center gap-4 text-white">
                            <MapPin className="w-6 h-6 shrink-0" />
                            <div className="text-sm">
                                <p className="font-bold">Jl. Merdeka no 45 Sintang</p>
                                <p className="text-white/80">Kabupaten Sintang, Kalimantan Barat</p>
                            </div>
                        </div>
                        <a href={googleMapsDirectUrl} target="_blank" rel="noreferrer" className="bg-white text-slate-900 font-bold py-3 px-8 rounded-xl text-sm hover:bg-slate-100 flex items-center gap-2 shadow-lg">
                            <ExternalLink className="w-4 h-4" /> Buka Google Maps
                        </a>
                    </div>
                </div>
            </section>
        </div>
    );
};

Contact.layout = (page: React.ReactNode) => <MainLayout children={page} />;

export default Contact;