    <style>
        .tab-button {
            position: relative;
            transition: all 0.2s ease-in-out;
        }

        .tab-button.active {
            border-bottom: 2px solid #2563eb;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #2563eb;
        }

        .tab-button.inactive:hover {
            color: #374151;
        }

        .tab-button.inactive:hover svg {
            color: #374151;
        }

        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Struktur Organisasi Chart Styles */
        .org-chart-container {
            width: 100%;
            overflow-x: auto;
            padding: 20px 0;
        }

        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }

        .org-level {
            display: flex;
            justify-content: center;
            width: 100%;
            position: relative;
        }

        .org-level::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            height: 20px;
            width: 2px;
            background-color: #94a3b8;
        }

        .org-level:first-child::before {
            display: none;
        }

        .org-level-directors {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 100%;
        }

        .org-box {
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            position: relative;
            transition: all 0.3s ease;
        }

        .org-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .org-head {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            color: white;
        }

        .org-secretary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .org-director {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            color: white;
        }

        .org-content {
            text-align: center;
        }

        .org-title {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .org-name {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        /* Connector lines for directors */
        .org-level-directors::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            width: 80%;
            height: 2px;
            background-color: #94a3b8;
            transform: translateX(-50%);
        }

        .org-level-directors .org-box::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            height: 20px;
            width: 2px;
            background-color: #94a3b8;
            transform: translateX(-50%);
        }

        @media (max-width: 768px) {
            .org-level-directors {
                grid-template-columns: 1fr;
            }

            .org-level-directors::before {
                width: 2px;
                height: calc(100% + 40px);
                top: -40px;
                left: 50%;
                transform: translateX(-50%);
            }

            .org-level-directors .org-box::before {
                height: 20px;
                top: -20px;
            }

            .org-chart {
                gap: 30px;
            }
        }
    </style>
