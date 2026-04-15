import React from 'react';
import doctorImg from "@/../images/doctor-hero.jpeg";
import { IdCardLanyard } from 'lucide-react';


const AboutDoctor = () => {
    return (
        <section className="bg-white py-16 px-6 md:px-12 lg:px-24 font-sans">
            <div className="text-center mb-16">
                <h1 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    About Dr. Sitek Ferryanto
                </h1>
                <p className="text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Dokter umum berpengalaman lebih dari 22 tahun, melayani masyarakat Sintang
                    dengan dedikasi penuh untuk kesehatan dan kesejahteraan Anda.
                </p>
            </div>

            <div className="flex flex-col md:flex-row items-stretch gap-12 max-w-6xl mx-auto">

                <div className="w-full md:w-1/2">
                    <div className="h-full min-h-[400px] overflow-hidden rounded-2xl shadow-lg">
                        <img
                            src={doctorImg}
                            alt="Dr. Sitek Ferryanto"
                            className="w-full h-full object-cover object-top"
                        />
                    </div>
                </div>

                <div className="w-full md:w-1/2 flex flex-col justify-center">
                    <div className="mb-6">
                        <div className="inline-flex items-center bg-green-50 text-green-600 px-3 py-1 rounded-full text-xs font-medium">
                            <span className="mr-2">
                                <IdCardLanyard />
                            </span> General Practitioner
                        </div>
                    </div>

                    <h2 className="text-3xl font-bold text-slate-900 mb-6">
                        Dr. Sitek Ferryanto
                    </h2>

                    <div className="space-y-6 text-slate-700 leading-relaxed">
                        <p>
                            Selamat datang di praktik mandiri saya. Saya adalah Dr. Sitek Ferryanto,
                            dokter umum yang telah berpraktik di Sintang selama lebih dari 22 tahun.
                            Dengan pengalaman yang luas dalam pelayanan kesehatan, saya berkomitmen
                            untuk memberikan perawatan medis terbaik bagi Anda dan keluarga.
                        </p>

                        <p>
                            Sepanjang karir saya, saya telah melayani ribuan pasien dari berbagai kalangan
                            usia mulai dari bayi, anak-anak, dewasa, hingga lansia. Pendekatan saya
                            adalah memberikan pelayanan yang ramah, personal, dan berbasis pada
                            kepercayaan jangka panjang dengan setiap pasien.
                        </p>

                        <p>
                            Saya bekerja sama dengan pemasok obat terpercaya seperti Buana Medistra Pharma,
                            Otto Pharmaceutical Industries, dan Pyridam Farma untuk memastikan ketersediaan
                            obat-obatan berkualitas dengan harga terjangkau bagi pasien saya.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default AboutDoctor;
