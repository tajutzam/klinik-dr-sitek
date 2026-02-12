import React from 'react';
import { Eye, Target } from 'lucide-react'; // Menggunakan lucide-react untuk icon

function VisiAndMission() {
    return (
        <section className="bg-[#eff4f8] py-16 px-6 md:px-12 lg:px-24">
            <div className="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

                {/* Card Visi */}
                <div className="bg-white p-10 rounded-2xl shadow-sm flex flex-col items-start">
                    <div className="flex items-center gap-4 mb-6">
                        <div className="bg-blue-50 p-3 rounded-lg">
                            <Eye className="w-8 h-8 text-blue-500" strokeWidth={1.5} />
                        </div>
                        <h2 className="text-2xl font-bold text-slate-800">Visi Kesehatan</h2>
                    </div>
                    <p className="text-slate-500 leading-relaxed text-[15px]">
                        Menjadi penyedia layanan kesehatan terdepan di Sintang yang dikenal
                        dengan pelayanan berkualitas, terpercaya, dan mudah diakses oleh
                        seluruh masyarakat.
                    </p>
                </div>

                {/* Card Misi */}
                <div className="bg-white p-10 rounded-2xl shadow-sm flex flex-col items-start">
                    <div className="flex items-center gap-4 mb-6">
                        <div className="bg-green-50 p-3 rounded-lg">
                            <Target className="w-8 h-8 text-green-500" strokeWidth={1.5} />
                        </div>
                        <h2 className="text-2xl font-bold text-slate-800">Misi Kesehatan</h2>
                    </div>
                    <ul className="space-y-4">
                        <li className="flex items-start gap-3 text-slate-500 text-[15px]">
                            <span className="mt-1.5 w-1.5 h-1.5 rounded-full bg-green-500 shrink-0" />
                            Memberikan pelayanan kesehatan yang cepat, tepat, dan terjangkau
                        </li>
                        <li className="flex items-start gap-3 text-slate-500 text-[15px]">
                            <span className="mt-1.5 w-1.5 h-1.5 rounded-full bg-green-500 shrink-0" />
                            Meningkatkan kepercayaan dengan pasien dalam dunia kesehatan
                        </li>
                        <li className="flex items-start gap-3 text-slate-500 text-[15px]">
                            <span className="mt-1.5 w-1.5 h-1.5 rounded-full bg-green-500 shrink-0" />
                            Meningkatkan kualitas hidup masyarakat melalui edukasi kesehatan
                        </li>
                    </ul>
                </div>

            </div>
        </section>
    );
}

export default VisiAndMission;