import React from 'react';

const ServiceFlow = () => {
    const steps = [
        {
            id: 1,
            title: "Booking atau Datang Langsung",
            description: "Anda dapat membuat janji temu melalui website atau datang langsung ke klinik. Booking online membantu menghemat waktu tunggu Anda."
        },
        {
            id: 2,
            title: "Pemeriksaan oleh Dokter",
            description: "Dr. Sitek Ferryanto akan melakukan pemeriksaan menyeluruh terhadap keluhan Anda dengan peralatan medis yang memadai."
        },
        {
            id: 3,
            title: "Penjelasan Kondisi & Tindakan",
            description: "Dokter akan menjelaskan diagnosis, kondisi kesehatan Anda, dan tindakan medis yang diperlukan secara jelas dan transparan."
        },
        {
            id: 4,
            title: "Pemberian Obat & Instruksi",
            description: "Anda akan menerima obat yang diperlukan beserta instruksi penggunaan dan hal-hal yang harus dilakukan untuk pemulihan optimal."
        }
    ];

    return (
        <section className="bg-slate-50 py-20 px-6 md:px-12 lg:px-24 font-sans">
            <div className="text-center mb-12">
                <h2 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    Alur Pelayanan
                </h2>
                <p className="text-slate-500">
                    Proses pelayanan yang mudah dan terstruktur
                </p>
            </div>

            <div className="max-w-4xl mx-auto space-y-4">
                {steps.map((step) => (
                    <div
                        key={step.id}
                        className="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-50 flex items-center gap-6 md:gap-8 transition-transform duration-300 hover:scale-[1.01]"
                    >
                        {/* Number Indicator - Menggunakan bg-primary */}
                        <div className="flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-primary rounded-full flex items-center justify-center text-white text-xl md:text-2xl font-bold shadow-primary/20 shadow-lg">
                            {step.id}
                        </div>

                        <div className="flex-grow">
                            <h3 className="text-lg md:text-xl font-bold text-slate-800 mb-2">
                                {step.title}
                            </h3>
                            <p className="text-slate-500 text-sm md:text-base leading-relaxed">
                                {step.description}
                            </p>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    );
};

export default ServiceFlow;