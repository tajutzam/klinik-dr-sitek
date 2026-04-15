import { CalendarCheck, CheckCircle, MessageCircle, Calendar } from "lucide-react";

const BookingSection = () => {
  return (
    <section id="booking" className="py-20 mb-5 bg-white">
      <div className="container mx-auto px-4">
        <div className="relative bg-white rounded-4xl overflow-hidden shadow-2xl shadow-primary/10 border border-slate-50">
          <div className="grid lg:grid-cols-2">

            <div className="p-8 lg:p-16">
              <span className="inline-flex items-center gap-2 bg-primary/10 text-primary text-xs font-bold px-4 py-2 rounded-full mb-6">
                <Calendar className="w-3.5 h-3.5" />
                Online Booking
              </span>

              <h2 className="text-3xl lg:text-4xl font-extrabold text-slate-900 mb-6 leading-tight">
                Buat Janji Temu <br /> dengan Mudah
              </h2>

              <p className="text-slate-500 mb-10 text-lg leading-relaxed max-w-md">
                Lewati antrean dan jadwalkan konsultasi Anda secara online. Cepat, sederhana, dan praktis.
              </p>

              <ul className="space-y-5 mb-12">
                {[
                  "Pilih tanggal dan waktu yang sesuai",
                  "Konfirmasi instan via WhatsApp",
                  "Hemat waktu tunggu Anda",
                ].map((item) => (
                  <li key={item} className="flex items-start gap-4">
                    <div className="bg-success/15 p-1 rounded shrink-0 mt-0.5">
                      <CheckCircle className="w-4 h-4 text-success" />
                    </div>
                    <span className="text-slate-600 font-medium">{item}</span>
                  </li>
                ))}
              </ul>

              <a
                href="https://wa.me/6289613943395"
                className="inline-flex items-center gap-3 bg-primary text-primary-foreground px-8 py-4 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg shadow-primary/25"
              >
                <MessageCircle className="w-5 h-5" />
                Chat via WhatsApp Sekarang
              </a>
            </div>

            <div className="bg-primary/5 relative flex items-center justify-center p-12 min-h-100">
              <div className="absolute inset-0 opacity-10 bg-[radial-gradient(var(--color-primary)_1px,transparent_1px)] [background-size:20px_20px]"></div>

              <div className="relative w-full max-w-[320px]">
                <div className="bg-white rounded-3xl shadow-2xl shadow-primary/20 p-8 flex items-center justify-center mb-6 animate-bounce-slow border border-primary/5">
                  <CalendarCheck className="w-16 h-16 text-primary" />
                </div>

                <div className="grid grid-cols-2 gap-4">
                  <div className="bg-white rounded-[20px] p-5 shadow-xl shadow-primary/10 text-center border border-primary/5">
                    <div className="text-2xl font-black text-primary mb-1">24/7</div>
                    <div className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Online Booking</div>
                  </div>

                  <div className="bg-white rounded-[20px] p-5 shadow-xl shadow-primary/10 text-center border border-primary/5">
                    <div className="text-2xl font-black text-success mb-1">&lt;5min</div>
                    <div className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Proses Cepat</div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  );
};

export default BookingSection;
