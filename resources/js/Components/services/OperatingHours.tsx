import React from 'react';
import { Calendar, Sun, Moon, Info } from 'lucide-react';

const OperatingHours = () => {
    const rules = [
        "Pasien diharapkan datang 10 menit sebelum jadwal untuk registrasi",
        "Mohon membawa kartu identitas dan kartu asuransi (jika ada)",
        "Untuk pembatalan atau perubahan jadwal, hubungi minimal 2 jam sebelumnya",
        "Kami menerapkan protokol kesehatan yang ketat untuk keamanan bersama"
    ];

    return (
        <section className="bg-white py-20 px-6 md:px-12 lg:px-24 font-sans">
            <div className="max-w-6xl mx-auto">

                {/* Tata Tertib Kunjungan */}
                <div className="border-2 border-primary/40 rounded-xl p-8 mb-20 bg-primary/5">
                    <h3 className="text-center font-bold text-slate-800 mb-6">Tata Tertib Kunjungan</h3>
                    <ul className="space-y-3 max-w-3xl mx-auto">
                        {rules.map((rule, index) => (
                            <li key={index} className="flex items-start gap-3 text-slate-600 text-sm md:text-base">
                                <span className="w-1.5 h-1.5 rounded-full bg-primary mt-2 shrink-0" />
                                {rule}
                            </li>
                        ))}
                    </ul>
                </div>

                {/* Jam Operasional Header */}
                <div className="text-center mb-12">
                    <h2 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                        Jam Operasional Praktik
                    </h2>
                    <p className="text-slate-500">Kami siap melayani Anda pada waktu berikut</p>
                </div>

                {/* Operating Cards Grid */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

                    {/* Hari Praktik */}
                    <div className="bg-white p-10 rounded-3xl shadow-xl shadow-slate-100 border border-slate-50 flex flex-col items-center text-center">
                        <div className="bg-primary p-4 rounded-xl mb-6 shadow-lg shadow-primary/20">
                            <Calendar className="w-8 h-8 text-white" />
                        </div>
                        <h3 className="text-xl font-bold text-slate-800 mb-4">Hari Praktik</h3>
                        <div className="bg-green-50 text-green-600 px-6 py-2 rounded-full font-bold">
                            Senin - Sabtu
                        </div>
                    </div>

                    {/* Sesi Pagi - Siang */}
                    <div className="bg-orange-50/30 p-10 rounded-3xl border border-orange-100 flex flex-col items-center text-center relative overflow-hidden">
                        <div className="bg-orange-500 p-4 rounded-xl mb-6 shadow-lg shadow-orange-200">
                            <Sun className="w-8 h-8 text-white" />
                        </div>
                        <span className="text-orange-800 font-bold text-sm mb-2">Sesi Pagi - Siang</span>
                        <div className="text-4xl font-black text-orange-900 mb-2">08:00</div>
                        <div className="w-12 h-1 bg-orange-400 mb-2 rounded-full" />
                        <div className="text-4xl font-black text-orange-900 mb-6">13:00</div>
                        <div className="bg-white/80 px-4 py-1 rounded-lg text-xs font-bold text-orange-800 border border-orange-100">
                            5 Jam Pelayanan
                        </div>
                    </div>

                    {/* Sesi Sore - Malam */}
                    <div className="bg-indigo-50/30 p-10 rounded-3xl border border-indigo-100 flex flex-col items-center text-center relative overflow-hidden">
                        <div className="bg-indigo-600 p-4 rounded-xl mb-6 shadow-lg shadow-indigo-200">
                            <Moon className="w-8 h-8 text-white" />
                        </div>
                        <span className="text-indigo-800 font-bold text-sm mb-2">Sesi Sore - Malam</span>
                        <div className="text-4xl font-black text-indigo-900 mb-2">17:00</div>
                        <div className="w-12 h-1 bg-indigo-400 mb-2 rounded-full" />
                        <div className="text-4xl font-black text-indigo-900 mb-6">21:00</div>
                        <div className="bg-white/80 px-4 py-1 rounded-lg text-xs font-bold text-indigo-800 border border-indigo-100">
                            4 Jam Pelayanan
                        </div>
                    </div>
                </div>

                {/* CTA Button */}
                <div className="flex justify-center mb-12">
                    <a href='https://wa.me/6289613943395' target='_blank' className="bg-primary hover:opacity-90 text-white font-bold py-4 px-10 rounded-xl shadow-lg shadow-primary/20 transition-all active:scale-95">
                        Konsultasi Kesehatan Sekarang
                    </a>
                </div>

                {/* Tip Box */}
                <div className="bg-primary/5 p-6 rounded-2xl flex items-start gap-4 border border-primary/10 max-w-4xl mx-auto">
                    <div className="bg-primary p-2 rounded-lg shrink-0">
                        <Info className="w-5 h-5 text-white" />
                    </div>
                    <p className="text-slate-600 text-sm leading-relaxed">
                        <span className="font-bold text-slate-800">Tip:</span> Booking janji temu online untuk menghindari antrian panjang. Kami akan mengkonfirmasi jadwal Anda melalui WhatsApp dalam waktu singkat.
                    </p>
                </div>

            </div>
        </section>
    );
};

export default OperatingHours;
