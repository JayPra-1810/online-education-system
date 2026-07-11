<?php require_once '../app/views/layouts/header.php'; ?>

<style>
    .certificate-container {
        font-family: 'Inter', sans-serif;
    }

    .cert-bg {
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        border: 20px solid #4f46e5;
        position: relative;
    }

    .cert-border-inner {
        border: 2px solid #e2e8f0;
        margin: 10px;
        padding: 60px;
        height: 100%;
    }

    .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-30deg);
        font-size: 8rem;
        font-weight: 900;
        color: rgba(79, 70, 229, 0.03);
        z-index: 0;
        white-space: nowrap;
        pointer-events: none;
    }

    @media print {

        header,
        footer,
        .no-print {
            display: none !important;
        }

        .main-container {
            padding: 0 !important;
        }

        body {
            background: white;
        }
    }
</style>

<div class="max-w-5xl mx-auto py-12 px-4 certificate-container">
    <div class="no-print flex justify-between items-center mb-8">
        <a href="<?= URL_ROOT?>/learning/course/<?= $data['course']->id?>"
            class="text-gray-500 hover:text-gray-900 flex items-center gap-2 font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Back to Course
        </a>
        <button onclick="window.print()"
            class="bg-primary text-white px-6 py-2.5 rounded-full font-bold hover:bg-purple-800 transition shadow-lg flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                </path>
            </svg>
            Print / Download PDF
        </button>
    </div>

    <div class="cert-bg rounded-lg shadow-2xl relative overflow-hidden bg-white aspect-[1.414/1]">
        <div class="watermark">LMSACADEMY</div>

        <div class="cert-border-inner flex flex-col items-center justify-between text-center relative z-10">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-gray-900 tracking-tight">LMS<span
                            class="text-primary italic">.LMS</span></span>
                </div>
                <h1 class="text-xs font-bold text-gray-400 uppercase tracking-[0.5em] mb-2">Certificate of Completion
                </h1>
            </div>

            <!-- Body -->
            <div class="flex-1 flex flex-col justify-center items-center py-8">
                <p class="text-gray-500 font-medium mb-4 italic">This is to certify that</p>
                <h2 class="text-5xl font-black text-gray-900 mb-6 font-serif tracking-tight">
                    <?= $data['user']->name?>
                </h2>
                <p class="text-gray-500 font-medium mb-8 max-w-lg mx-auto leading-relaxed">has successfully completed
                    all requirements of the comprehensive online course</p>
                <h3 class="text-3xl font-extrabold text-primary mb-12 max-w-2xl">
                    <?= $data['course']->title?>
                </h3>
                <p class="text-gray-400 text-sm">Issued on
                    <?= date('F d, Y', strtotime($data['certificate']->issued_at))?>
                </p>
            </div>

            <!-- Footer -->
            <div class="w-full flex justify-between items-end mt-8 border-t border-gray-100 pt-10">
                <div class="text-left">
                    <div class="h-1 bg-gray-900 w-48 mb-2"></div>
                    <p class="font-bold text-gray-900">Dr. Sarah Jenkins</p>
                    <p class="text-xs text-gray-500 font-medium">Head of Education, LMS Academy</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-100 p-2 rounded-lg border border-gray-200 mb-2">
                        <!-- Dummy QR Code -->
                        <div class="w-full h-full bg-gray-300 opacity-50 flex flex-col justify-between p-1">
                            <div class="flex justify-between">
                                <div class="w-3 h-3 bg-gray-600"></div>
                                <div class="w-3 h-3 bg-gray-600"></div>
                            </div>
                            <div class="flex justify-between">
                                <div class="w-3 h-3 bg-gray-600"></div>
                                <div class="w-3 h-3 bg-gray-600"></div>
                            </div>
                        </div>
                    </div>
                    <p class="text-[8px] text-gray-400 uppercase font-bold tracking-widest">Verify Authenticity</p>
                    <p class="text-[8px] text-gray-400 font-mono">
                        <?= $data['certificate']->certificate_url?>
                    </p>
                </div>

                <div class="text-right">
                    <div class="h-1 bg-gray-900 w-48 mb-2 ml-auto"></div>
                    <p class="font-bold text-gray-900">
                        <?= $data['course']->creator_name?>
                    </p>
                    <p class="text-xs text-gray-500 font-medium">Course Instructor</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>