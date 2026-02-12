import { CheckCircle, Star, Shield, Award } from "lucide-react";
import CountUp from 'react-countup';
import { TypeAnimation } from 'react-type-animation';

import doctorImg from "@/../images/doctor-hero.jpg";

const HeroSection = () => {
  return (
    <section id="home" className="bg-hero-bg py-16 lg:py-24">
      <div className="container mx-auto px-4">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          <div className="animate-fade-in-up">
            <span className="inline-flex items-center gap-2 bg-green-100 text-green-700 text-xs font-semibold px-4 py-2 rounded-full mb-6">
              <Shield className="w-3.5 h-3.5 text-green-700" />
              22+ Tahun Pengalaman Medis
            </span>

            <h1 className="text-4xl lg:text-5xl font-extrabold text-foreground leading-tight mb-6 min-h-[120px] lg:min-h-[150px]">
              Pelayanan Kesehatan{" "}
              <span className="text-primary block md:inline">
                <TypeAnimation
                  sequence={[
                    'yang Terpercaya',
                    2000,
                    'yang Profesional',
                    2000,
                    'yang Personal',
                    2000,
                    'untuk Keluarga',
                    2000
                  ]}
                  wrapper="span"
                  speed={50}
                  repeat={Infinity}
                  cursor={true}
                />
              </span>
            </h1>
            <p className="text-muted-foreground mb-8 max-w-md leading-relaxed">
              Dr. Sitek Ferryanto, dokter umum berpengalaman di Sintang Kalimantan Barat dengan pendekatan personal, ramah, dan profesional untuk kesehatan Anda sekeluarga.
            </p>

            <div className="flex gap-8 mb-8">
              {[
                { value: 5000, suffix: "+", label: "Pasien Puas" },
                { value: 22, suffix: "+", label: "Tahun Praktik" },
                { value: 15, suffix: "+", label: "Layanan" },
              ].map((s) => (
                <div key={s.label}>
                  <div className="text-2xl font-extrabold text-primary flex items-center">
                    <CountUp
                      end={s.value}
                      duration={3}
                      enableScrollSpy={true}
                      scrollSpyOnce={true}
                    />
                    <span>{s.suffix}</span>
                  </div>
                  <div className="text-xs text-muted-foreground">{s.label}</div>
                </div>
              ))}
            </div>

            <a href="#contact" className="inline-block bg-primary text-primary-foreground px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity mb-6">
              Hubungi Kami
            </a>

            <div className="flex flex-wrap gap-4 text-xs text-muted-foreground">
              {["Obat Berkualitas", "Harga Terjangkau", "Pelayanan Ramah"].map((t) => (
                <span key={t} className="flex items-center gap-1.5">
                  <CheckCircle className="w-3.5 h-3.5 text-success" />
                  {t}
                </span>
              ))}
            </div>
          </div>

          <div className="relative flex justify-center animate-fade-in-up" style={{ animationDelay: "0.2s" }}>
            <div className="relative">
              <img
                src={doctorImg}
                alt="Dr. Sitek Ferryanto"
                className="w-72 lg:w-85 rounded-3xl object-cover shadow-2xl"
              />

              <div className="absolute -top-6 -right-6 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3 min-w-[160px]">
                <div className="bg-green-100 p-2 rounded-xl">
                  <Star className="w-6 h-6 text-green-600 " />
                </div>
                <div>
                  <div className="text-xl font-bold text-slate-900 leading-none">100%</div>
                  <div className="text-[11px] text-slate-500 mt-1">Kepuasan Pasien</div>
                </div>
              </div>

              <div className="absolute -bottom-6 -left-10 bg-blue-600 text-white rounded-2xl shadow-xl p-5 flex items-center gap-4">
                <div className="bg-white/20 p-2.5 rounded-xl">
                  <Award className="w-7 h-7 text-white" />
                </div>
                <div>
                  <div className="text-2xl font-bold leading-none">22+</div>
                  <div className="text-[11px] text-blue-100 mt-1">Tahun Berpengalaman</div>
                </div>
              </div>
            </div>

            <p className="absolute -bottom-14 text-lg font-bold text-slate-900">
              Dr. Sitek Ferryanto
            </p>
          </div>
        </div>
      </div>
    </section>
  );
};

export default HeroSection;
