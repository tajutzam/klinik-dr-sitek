import { Zap, MessageCircle, ClipboardCheck, Users2 } from 'lucide-react';
import CountUp from 'react-countup';

const OurAdvantages = () => {
    const advantages = [
        {
            icon: <Zap className="w-6 h-6 text-white" />,
            iconBg: "bg-primary",
            cardBg: "bg-blue-50/50",
            title: "Pelayanan Cepat",
            desc: "Proses pemeriksaan yang efisien tanpa mengurangi kualitas diagnosis. Waktu tunggu minimal dengan sistem appointment yang baik."
        },
        {
            icon: <MessageCircle className="w-6 h-6 text-white" />,
            iconBg: "bg-green-500",
            cardBg: "bg-green-50/50",
            title: "Dr. Yang Komunikatif",
            desc: "Penjelasan yang mudah dipahami tentang kondisi kesehatan Anda. Dokter yang sabar mendengarkan keluhan dan menjawab pertanyaan."
        },
        {
            icon: <ClipboardCheck className="w-6 h-6 text-white" />,
            iconBg: "bg-cyan-400",
            cardBg: "bg-cyan-50/50",
            title: "Pemeriksaan Transparan",
            desc: "Diagnosis yang jelas dengan penjelasan detail. Transparansi biaya sejak awal tanpa biaya tersembunyi."
        },
        {
            icon: <Users2 className="w-6 h-6 text-white" />,
            iconBg: "bg-primary",
            cardBg: "bg-blue-50/50",
            title: "Suitable For All Ages",
            desc: "Melayani pasien dari segala usia bayi, anak-anak, dewasa, hingga lansia. Pendekatan yang disesuaikan dengan kebutuhan."
        }
    ];

    const stats = [
        { value: 22, suffix: "+", label: "Years of Service" },
        { value: 5000, suffix: "+", label: "Happy Patients" },
        { value: 15, suffix: "+", label: "Services Offered" },
        { value: 100, suffix: "%", label: "Patient Satisfaction" }
    ];
    return (
        <section className="bg-white py-20 px-6 md:px-12 lg:px-24 font-sans text-center">
            <div className="mb-16">
                <h2 className="text-3xl font-bold text-slate-900 mb-4">Keunggulan Praktik Kami</h2>
                <p className="text-slate-500">Mengapa pasien memilih praktik Dr. Sitek Ferryanto untuk kebutuhan kesehatan mereka</p>
            </div>

            <div className="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                {advantages.map((item, idx) => (
                    <div key={idx} className={`${item.cardBg} p-8 rounded-2xl text-left flex flex-col items-start`}>
                        <div className={`${item.iconBg} p-3 rounded-lg mb-6 shadow-sm`}>
                            {item.icon}
                        </div>
                        <h3 className="text-lg font-bold text-slate-800 mb-3">{item.title}</h3>
                        <p className="text-slate-500 text-sm leading-relaxed">{item.desc}</p>
                    </div>
                ))}
            </div>

            <div className="max-w-5xl mx-auto bg-slate-50 rounded-3xl p-10 mb-20">
                <h3 className="text-xl font-bold text-slate-800 mb-4">Wawasan Tepat untuk Setiap Pasien</h3>
                <p className="text-slate-500 text-[15px] leading-relaxed max-w-4xl mx-auto">
                    Dr. Sitek Ferryanto tidak hanya memberikan resep, tetapi juga memberikan edukasi kesehatan yang tepat
                    untuk setiap pasien. Anda akan mendapatkan pemahaman yang jelas tentang kondisi kesehatan Anda,
                    cara pencegahan, dan langkah-langkah perawatan yang perlu dilakukan di rumah.
                </p>
            </div>

            <div className="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
                {stats.map((stat, idx) => (
                    <div key={idx} className="flex flex-col items-center">
                        <span className="text-4xl md:text-5xl font-extrabold text-primary mb-2 flex items-center">
                            <CountUp
                                end={stat.value}
                                duration={2.5}
                                enableScrollSpy={true}
                                scrollSpyOnce={true}
                            />
                            <span>{stat.suffix}</span>
                        </span>
                        <span className="text-slate-400 text-sm font-medium">{stat.label}</span>
                    </div>
                ))}
            </div>
        </section>
    );
};

export default OurAdvantages;