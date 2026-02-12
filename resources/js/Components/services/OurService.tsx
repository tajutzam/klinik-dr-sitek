import React from 'react';
import { Stethoscope, Activity, Baby, Users, Pill, ActivitySquare } from 'lucide-react';

const OurServices = () => {
    const services = [
        {
            icon: <Stethoscope className="w-6 h-6 text-blue-500" />,
            title: "Konsultasi Umum",
            description: "Pemeriksaan dan konsultasi untuk berbagai keluhan kesehatan ringan hingga sedang dengan diagnosis yang tepat."
        },
        {
            icon: <Activity className="w-6 h-6 text-blue-500" />,
            title: "Medical Check-up",
            description: "Pemeriksaan kesehatan rutin dan skrining untuk deteksi dini penyakit dengan pemeriksaan menyeluruh."
        },
        {
            icon: <Baby className="w-6 h-6 text-blue-500" />,
            title: "Kesehatan Anak",
            description: "Pelayanan kesehatan untuk bayi dan anak-anak, termasuk pemantauan tumbuh kembang."
        },
        {
            icon: <Users className="w-6 h-6 text-blue-500" />,
            title: "Perawatan Lansia",
            description: "Pelayanan kesehatan untuk lanjut usia dengan manajemen penyakit kronis secara teratur."
        },
        {
            icon: <Pill className="w-6 h-6 text-blue-500" />,
            title: "Penyediaan Obat",
            description: "Obat-obatan berkualitas dari supplier terpercaya dengan harga yang terjangkau."
        },
        {
            icon: <ActivitySquare className="w-6 h-6 text-blue-500" />,
            title: "Tindakan Medis",
            description: "Tindakan medis dasar seperti perawatan luka, injeksi, dan prosedur medis sederhana."
        }
    ];

    return (
        <section id="services" className="bg-white py-20 px-6 md:px-12 lg:px-24 font-sans">
            <div className="text-center mb-16">
                <h2 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    Layanan Kesehatan Utama Kami
                </h2>
                <div className="space-y-1">
                    <p className="text-slate-600">Pelayanan medis profesional untuk kesehatan Anda dan keluarga</p>
                    <p className="text-slate-600">Berbagai layanan kesehatan yang kami sediakan</p>
                </div>
            </div>

            <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {services.map((service, index) => (
                    <div
                        key={index}
                        className="group bg-white p-10 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-start"
                    >
                        <div className="bg-blue-50 w-14 h-14 rounded-xl flex items-center justify-center mb-8 group-hover:bg-blue-100 transition-colors">
                            {service.icon}
                        </div>

                        <h3 className="text-xl font-bold text-slate-900 mb-4">
                            {service.title}
                        </h3>
                        <p className="text-slate-500 leading-relaxed text-[15px]">
                            {service.description}
                        </p>
                    </div>
                ))}
            </div>
        </section>
    );
};

export default OurServices;